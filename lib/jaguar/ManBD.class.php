<?php
  class ManBD
  {
    /** @var JDBConn */
    public $objConn;
    
    /** @var Erro */
    public $objErro;
    public $ultimoObjetoUpdate;
    public $valuesUpdate = array();
    public $throwExceptions;
    public $mostrarErro;
    public $idRodarGatilhos;
    private $idDepoisInserir;
    private $idDepoisAtualizar;
    private $id_update;
    
    private static $instance;
    
    /**
     * 
     * @param Erro $Erro 
     * @param boolean throwExceptions 
     */    
    public function __construct(Erro &$Erro, $throwExceptions=false, $mostrarErro=true)
    {
      $this->objErro = $Erro;
      $this->objConn = $Erro->objConn;
      $this->throwExceptions = $throwExceptions;
      $this->mostrarErro = $mostrarErro;
      $this->idRodarGatilhos = true;
    }
    
    /**
     * Persiste objeto em questão
     * @param object $obj 
     */
    public function salvar(&$obj)
    {
      try
      {
        $this->id_update = $this->existe_objeto($obj);

        if ($this->id_update) 
          $this->update($obj);
        else 
          $this->insert($obj);
        
        //Seta como false para não ocorrer problema com o PopulaObjetoGenerico
        $this->id_update = false;
      }
      catch (Aviso $e)
      {
        $this->objErro->ds_aviso .= $e->getMessage();

        if ($this->throwExceptions)
          throw $e;
      }
      catch (Exception $e)
      {
        $this->id_update = false;
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }
    
    /**
     * Exclui o objeto caso o mesmo não possua dependência
     * @param object $obj
     * @return null 
     */
    public function excluir(&$obj)
    {
      try
      {
        if (!is_array($obj->key))
          throw new Exception("Erro ao excluir: ".get_class($obj) . " sem chave.");
        
        $where = $this->monta_where($obj);

        if (!is_array($where) || count($where) <= 0) return;

        //Coloca gatilho para função antes_excluir do objeto possibilitando regra de negócio do objeto
        if (method_exists($obj, "antes_excluir") && $this->idRodarGatilhos)
          $obj->antes_excluir($this);

        if (!$this->objConn->Delete($obj->table, $where))
          throw new Exception("Erro ao excluir ". get_class($obj));

        //Coloca gatilho para função depois_excluir do objeto possibilitando regra de negócio do objeto
        if (method_exists($obj, "depois_excluir") && $this->idRodarGatilhos)
          $obj->depois_excluir($this);
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }
    
    /**
     * Testa se o objeto existe, verificando a chave
     * @param object $obj
     * @return boolean 
     */
    private function existe_objeto(&$obj)
    {
      $newObj = get_class($obj);
      $newObj = new $newObj($this->objConn);
      
      $where = $this->monta_where($obj);
      $this->PopulaObjetoGenerico($newObj, $where);
      
      foreach ($newObj->key AS $campo)
      {
        if (str_value($newObj->$campo))
        {
          $this->ultimoObjetoUpdate = $newObj;
          return true;
        }
      }
      
      return false;
    }
    
    /**
     * Insere objeto
     * @param object $obj 
     */
    private function insert(&$obj)
    {
      //Coloca gatilho para função antes_inserir do objeto possibilitando regra de negócio do objeto
      if (method_exists($obj, "antes_inserir") && $this->idRodarGatilhos)
        $obj->antes_inserir($this);

      $this->seta_chave_objeto($obj);
      $values = $this->monta_values($obj);

      if (!$this->objConn->Insert($obj->table, $values))
        throw new Exception("Erro ao inserir ". get_class($obj).":\n" . $this->objConn->GetError(true));

      //Coloca gatilho para função depois_inserir do objeto possibilitando regra de negócio do objeto
      if (method_exists($obj, "depois_inserir") && !$this->idDepoisInserir && $this->idRodarGatilhos)
      {
        $this->idDepoisInserir = true;
        
        $obj->depois_inserir($this);
        
        $this->idDepoisInserir = false;
      }
    }

    /**
     * Compara o objeto que está sendo atualizado para deixar apenas os atributos que o valor foi alterado
     * @param $obj
     * @return array
     */
    private function retornarValuesUpdate($obj)
    {
      if (!is_object($this->ultimoObjetoUpdate)) return array();
      
      $values = array(); 
      foreach ($this->ultimoObjetoUpdate AS $att => $valor)
      {
        if (is_object($valor))
          continue;

        if (strpos($att, "_") != 2 && get_class($this->objConn->mDriver) != "JDBConnMssql")
          continue;

        if (get_class($this->objConn->mDriver) == "JDBConnMssql" && in_array($att, array("key", "table")))
          continue;

        if (substr($att, 0, 3) === "ar_")
        {
          $valorNew = ifnull($obj->$att, array());

          if (is_string($valorNew))
            $valorNew = explode(",", str_replace(array("{", "}", "'"), "", $valorNew));

          if (is_array($valorNew))
          {
            $ReflectionProperty = new ReflectionProperty($obj, $att);
            $dsDoc = $ReflectionProperty->getDocComment();

            // Se o campo é texto ou data, adicionar aspas
            if (preg_match('/(text|date)\[\]/i', $dsDoc))
            {
              $dsArValorOld = !count($valor) ? "NULL" : "{'" . implode("','", $valor) . "'}";
              $dsArValorNew = !count($valorNew) ? "NULL" : "{'" . implode("','", $valorNew) . "'}";
            }
            else
            {
              $dsArValorOld = !count($valor) ? "NULL" : "{" . implode(",", $valor) . "}";
              $dsArValorNew = !count($valorNew) ? "NULL" : "{" . implode(",", $valorNew) . "}";
            }

            if ($dsArValorOld !== $dsArValorNew)
            {
              $values["$att"] = $dsArValorNew;
              continue;
            }
          }
          else
            continue;
        }

        if (in_array($att, $this->ultimoObjetoUpdate->key))
          continue;        
        
        if (strcmp((string) $this->ultimoObjetoUpdate->$att, (string) $obj->$att) == 0 || 
            (!str_value($this->ultimoObjetoUpdate->$att) && strtoupper($obj->$att) == "NULL") ||
             !strlen($obj->$att))
          continue;

        if (strtoupper($obj->$att) == "NULL")
          $obj->$att = null;

        $values["$att"] = $obj->$att;
      }
      
      return $values;
    }
    
    /**
     * Atualiza objeto 
     * @param object $obj
     * @return null 
     */
    private function update(&$obj)
    {
      //Coloca gatilho para função antes_atualizar do objeto possibilitando regra de negócio do objeto
      if (method_exists($obj, "antes_atualizar") && $this->idRodarGatilhos)
        $obj->antes_atualizar($this);
      
      $this->valuesUpdate = $this->retornarValuesUpdate($obj);
      $where = $this->monta_where($obj);
      
      if (!is_array($where) || count($where) <= 0 || !count($this->valuesUpdate)) return;

      //Seta id_update para false pois os gatilhos pode usar o ManBD e gerar problema
      $this->id_update = false;
      
      if (!$this->objConn->Update($obj->table, $this->valuesUpdate, $where))
        throw new Exception("Erro ao atualizar ". get_class($obj) .".\n");

      //Coloca gatilho para função depois_atualizar do objeto possibilitando regra de negócio do objeto
      if (method_exists($obj, "depois_atualizar") && 
          (!$this->idDepoisAtualizar && !$this->idDepoisInserir) && 
          $this->idRodarGatilhos)
      {
        $this->idDepoisAtualizar = true;
        
        $obj->depois_atualizar($this);
        
        $this->idDepoisAtualizar = false;
      }
    }
    
    /**
     * Seta chave incremental do objeto 
     * @param object $obj 
     */
    private function seta_chave_objeto(&$obj)
    {
      foreach ($obj->key AS $campo)
      {
        if (!str_value($obj->$campo))
          $obj->$campo = $this->obterNextval($obj->table . "_" . $campo . "_seq");
      }
    }

    /**
     * Obtem chave incremental do campo
     * @param string $sequence
     * @return int
     * @throws Exception
     */
    private function obterNextval($sequence)
    {
      if (!$rs = $this->objConn->Select("SELECT nextval('public.{$sequence}')"))
        throw new Exception("Erro: Problema ao buscar próxima chave em {$sequence}.");
      else
        return $rs->GetField(0);
    }

    /**
     * Monta array com os campos / valores do objeto
     * @param object $obj
     * @return array  
     */
    private function monta_values(&$obj, $populaObjeto = false)
    {
      $values = array(); 

      foreach ($obj as $key => $value)
      {
        if (is_object($value))
          continue;
        
        if (!str_value($value))
          continue;

        if (strpos($key, "_") != 2 && get_class($this->objConn->mDriver) != "JDBConnMssql")
          continue;

        if (get_class($this->objConn->mDriver) == "JDBConnMssql" && in_array($key, array("key", "table")))
          continue;
        
        if (is_array($value))
          continue;
        
        if (in_array($key, $obj->key) && $this->id_update && !$populaObjeto)                
          continue;
        
        if (strtoupper($value) == "NULL" && !$populaObjeto)
          $obj->$key = null;          

        $values["$key"] = $value;
      }

      return $values;
    }

    /**
     * Monta array com os campos e valores do objeto para utilizar no where
     * @param object $obj
     * @return array 
     */
    private function monta_where(&$obj)
    {
      $where = array();
      
      if (!is_array($obj->key))
        throw new Exception(get_class($obj) . " sem chave.");
      
      foreach ($obj->key AS $campo)
      {
        if (str_value($obj->$campo))
          $where[$campo] = $obj->$campo;
      }
      
      return $where;
    }
  
    /**
     * Popula objeto baseado em um rs 
     * @param array $arr_obj
     * @param object $rs
     * @return null 
     */
    public function PopulaObjetoRs($arr_obj, &$rs)
    {
      try
      {
        if (!is_array($arr_obj)) return;
        if (!is_object($rs)) return;

        foreach ($rs->mFields AS $key => $value)
        {
          $nome_coluna        = pg_field_name($rs->mDriver->mResult, $key);
          $table              = pg_field_table($rs->mDriver->mResult, $key);
          $classe             = substr($nome_coluna, strrpos($nome_coluna, "_") + 1);
          $nome_coluna_classe = substr($nome_coluna, 0, strrpos($nome_coluna, "_"));

          foreach ($arr_obj AS $classe_nome => $obj)
          {
            if ($classe_nome === $classe)
              $obj->$nome_coluna_classe = $rs->GetField($key);
            elseif ($table == $obj->table)
              $obj->$nome_coluna = $rs->GetField($key);
            elseif ($classe == strtolower(get_class($obj)))
              $obj->$nome_coluna_classe = $rs->GetField($key);
          }
        }
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    private function PopulaObjeto(&$obj, $rs)
    {
      try
      {
        if (!is_object($obj)) return;
        if (!is_array($rs)) return;

        $rs = $rs[0];
        foreach ($obj AS $key => $value)
        {
          if (!is_object($value) && $key != "table" && $key != "key")
            $obj->$key = $rs[$key]; 
        }
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    /**
     * Popula objeto de uma manutenção
     * @param object $obj
     * @param object $man
     * @param string $extra_join
     * @param string $extra_where
     * @return object 
     */
    public function PopulaObjetoManutencao(&$obj, &$man, $extra_join=null, $extra_where=null)
    {
      try
      {
        $sql = "SELECT * FROM ".$man->mDBTable." $extra_join ".$man->mWhere . " $extra_where ";
        if (!$rs = $this->objConn->Select($sql))
          throw new Exception("Erro ao popular objeto.");
        elseif (!$rs->GetRowCount())
          return;
        else
        {
          $arr = array();
          foreach ($obj AS $key => $value)
          {
            if (!is_object($value))
              $arr[0][$key] = $rs->GetField("$key");
          }
          return $this->PopulaObjeto($obj, $arr);
        }
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    /**
     * Popula qualquer objeto 
     * @param object $obj
     * @param array $arr_where
     * @param string $extra_where
     * @param boolean $lazy
     * @return mixed 
     */
    public function PopulaObjetoGenerico(&$obj, $arr_where = false, $extra_where = false, $lazy = true, $extraWhereLazy = array())
    {
      try
      {
        if (!is_array($obj->key))
          throw new Exception(get_class($obj) . " sem chave.");

        if (!str_value($obj->table)) 
          throw new Exception("Objeto " . get_class($obj) . " sem tabela.");
        
        if (!is_array($arr_where))
          $arr_where = $this->monta_values($obj, true);

        if (count($arr_where) == 0) return;

        $where  = "";
        foreach($arr_where AS $key => $value)
        {
          if (str_value($value) && strtoupper($value) !== "NULL")
            $where .= " ".(str_value($where)?"AND":"WHERE")." $key = " . $this->objConn->QuoteValue($value) . " ";
        }

        if (str_value($extra_where))
          $where .= $extra_where;

        if (!str_value($where)) return;

        /**
         * instancia novamente o objeto para pegar o atributo "table" original
         */
        $tmpObj = get_class($obj);
        $tmpObj = new $tmpObj($this->objConn);

        $sql = "SELECT {$tmpObj->table}.* FROM {$obj->table} $where";

        unset($tmpObj);

        if (!$rs = $this->objConn->Select($sql))
          throw new Exception("Erro ao executar SQL.");
        elseif (!$rs->GetRowCount())
        {
            $obj = get_class($obj);
            $obj = new $obj($this->objConn);
            return array();
        }
        else 
        {
          $arr_obj_principal = array();
          while (!$rs->IsEof())
          {
            $arr = array();
            $arr_list = array();
            $arr_obj = array();
            $class_principal = get_class($obj);
            $newObj = new $class_principal($this->objConn);

            foreach ($newObj AS $key => $value)
            {
              if (!is_object($value))
              {
                $list = explode("_", $key);

                if (substr($key, 0, 3) == "ar_" && str_value($rs->GetFieldNumber("$key")))
                  $arr[0][$key] = array_filter(explode(",", str_replace(array("{", "}", "'"), "", $rs->GetField("$key"))), "str_value");
                elseif ($list[0] != "list" && $list[0] != "obj" && $key != "key" && $key != "table")
                  $arr[0][$key] = $rs->GetField("$key");
                elseif ($list[0] == "list")
                  $arr_list[] = $key;
                elseif ($list[0] == "obj")
                  $arr_obj[] = $key;
              }

            }

            $this->PopulaObjeto($newObj, $arr);

            if (!$lazy)
            {
              if (count($arr_list) > 0)
              {
                foreach ($arr_list AS $valor)
                {
                  $newObj->{$valor} = $this->PopulaList($valor, $newObj, $extraWhereLazy);
                }
              }

              if (count($arr_obj) > 0)
              {
                foreach ($arr_obj AS $valor)
                {
                  $newObj->{$valor} = $this->PopulaObj($valor, $newObj);
                }
              }
            }

            $arr_obj_principal[] = $newObj;
            unset($newObj);
            $rs->Next();
          }
          
          if (count($arr_obj_principal) == 1)
            $obj = $arr_obj_principal[0]; 
          else 
            $obj = $arr_obj_principal;
          
          return $arr_obj_principal;
        }
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    /**
     * Popula atributos do objeto
     * @param object $obj
     * @param object $obj_principal
     * @return ObjName 
     */
    private function PopulaObj($obj, &$obj_principal)
    {
      if (!str_value($obj_principal->key)) return;

      $ObjName = explode("_", $obj);
      $ObjFake = new $ObjName[1]($this->objConn);
      $arr_where = $ObjFake->key;
      $where = array();

      foreach($arr_where AS $value)
      {
        if (str_value($value))
          $where[$value] = $obj_principal->{$value};
      }
      
      $Obj = new $ObjName[1]($this->objConn);
      $extra_where = "";
      $this->PopulaObjetoGenerico($Obj, $where, $extra_where);
      return $Obj;
    }

    /**
     * Popula uma lista de objetos
     * @param string $list
     * @param object $obj_principal
     * @return array 
     */
    public function PopulaList($list, &$obj_principal, $extraWhere = array())
    {
      try
      {
        if (!str_value($obj_principal->key)) return;

        $ObjListName = explode("_", $list);
        $where = $this->monta_where($obj_principal);
        
        if (is_array($where))
        {
          $sql_where = "";
          foreach($where AS $key => $value)
          {
            if (str_value($value))
              $sql_where .= " ".(str_value($sql_where) ? "AND" : "WHERE")." $key = '$value' ";
          }
        }

        $ListObj = new $ObjListName[1]($this->objConn);

        foreach ($extraWhere AS $class => $eWhere)
        {
          if (strtolower($class) == strtolower(get_class($ListObj)))
            $sql_where .= " " . $eWhere;
        }

        if (!is_array($ListObj->key) || !str_value($ListObj->table) || !str_value($sql_where)) return;

        $sql = "SELECT * FROM $ListObj->table $sql_where";
        if ($rs = $this->objConn->Select($sql))
        {
          $list = array();

          while (!$rs->IsEof())
          {
            $where = array();
            $ListObj = new $ObjListName[1]($this->objConn);

            foreach ($ListObj->key AS $chave)
            {
              $where[$chave] = $rs->GetField($chave); 
            }

            $this->PopulaObjetoGenerico($ListObj, $where);
            $list[] = $ListObj;
            $rs->Next();
          }
          return $list;
        }         
        else      
          if ($this->mostrarErro) conn_mostra_erro();
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    /**
     * Adiciona vários objetos na sessão para que possam ser buscados pelo BuscaObjetoSessao
     * @param array $arr_obj 
     */
    public function AdicionaObjetoSessao($arr_obj)
    {
      try
      {
        foreach ($arr_obj AS $key => $obj)
          $_SESSION[$key] = serialize($obj);
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }

    /**
     * Busca um objeto em específico na sessão
     * @param string $obj_name
     * @return object 
     */
    public function BuscaObjetoSessao($obj_name)
    {
      try
      {
        $obj = unserialize($_SESSION[$obj_name]);
        unset($_SESSION[$obj_name]);
        return $obj;
      }
      catch (Exception $e)
      {
        $this->objErro->ds_erro .= $e->getMessage();
        if ($this->mostrarErro && $e->getCode() == PGSQL_FATAL_ERROR) conn_mostra_erro();
        if ($this->throwExceptions) throw $e;
      }
    }
    
    public function isUpdate(&$obj)
    {
      if (is_object($this->ultimoObjetoUpdate) && get_class($this->ultimoObjetoUpdate) == get_class($obj))
        return true;
      
      return false;
    }
    
    /**
     * Retorna a instancia da classe. (singleton)
     * @return ManBD
     */
    public static final function getInstance()
    {
      if (isset(self::$instance))
        return self::$instance;
      
      self::$instance = new ManBD(Erro::getInstance());
      return self::$instance;
    }

    /**
     * ManBD::getObject(...)
     *
     * Retorna um array com o(s) objeto(s) populado(s) pelo ManBD.<br><br>
     *
     * Para isso a classe em questão deve ter a marcação "@uses getObject"<br><br>
     *
     * @uses ajaxComplete
     * @param string $className
     * @param array $keys Por padrão só é permitido o uso das chaves que estão no atributo key da classe em questão. <br>
     * Para usar mais chaves adicicionar a marcação "@uses getObject keys[attr_1, attr2, ...]"
     * @param bool $lazy Para usar esta funcionalidade a classe deve ter a marcação "@uses getObjectLazy"
     * @return mixed
     * @throws Exception<br><br>
     *
     * Exemplos: <br><br><br>
     *
     *
     * "@uses getObject"
     * "@uses getObjectLazy" <br><br>
     *
     * "@uses getObject keys[nr_registro_antt,id_ativo]"
     * "@uses getObjectLazy keys[nr_registro_antt,id_ativo]"
     * "@uses getObject keys [
     *   nr_registro_antt,
     *   id_ativo
     *  ]"
     */
    public static function getObject($className="Unknown", $keys=array(), $lazy=true)
    {
      if (!class_exists($className))
        throw new Exception("Classe [{$className}] não encontrada.");

      $Reflection      = new ReflectionClass($className);
      $classDocComment = $Reflection->getDocComment();

      if (!preg_match('/@uses\s+getObject/', $classDocComment))
        throw new Exception("Classe [{$className}] não possui a notação (@uses getObject).");

      if (!$lazy && !preg_match('/@uses\s+getObjectLazy/', $classDocComment))
        throw new Exception("Impossível popular a classe [{$className}] com \$lazy=false, pois a mesma  não possui a notação (@uses getObjectLazy).");

      $$className = new $className(JDBConn::getInstance());

      $allowedKeys = array();
      preg_match('/(getObject|getObjectLazy)\s*keys\s*\[(?P<keys>[^\]]+)\]/', $classDocComment, $allowedKeys);

      $allowedKeys = array_filter(preg_split('/\W+/', $allowedKeys["keys"]), "str_value");
      $allowedKeys = array_merge($allowedKeys, $$className->key);

      foreach ($keys as $key => $value)
      {
        if (!property_exists($className, $key) || (!in_array($key, $allowedKeys)))
          throw new Exception("Atributo [{$key}] inexistente, não acessível, ou o uso do mesmo não é permitido na classe [{$className}].");

        $$className->{$key} = $value;
      }

      $ManBD                  = new ManBD(Erro::getInstance());
      $ManBD->throwExceptions = true;

      return $ManBD->PopulaObjetoGenerico($$className, false, false, $lazy);
    }

  }
