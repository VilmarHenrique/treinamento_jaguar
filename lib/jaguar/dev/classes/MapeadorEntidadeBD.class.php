<?php
  class MapeadorEntidadeBD 
  {
    /** @var ManBD */
    private $ManBD;
    
    /** @var Array */
    private $arrAtributos;
    
    /** @var Array */
    private $arrChavesPrimarias;
    
    /** @var Array */
    private $arrConstraintCheck;
    
    /** @var Array */
    private $arrTabelas;
    
    /** @param ManBD $ManBD */
    public function __construct(ManBD $ManBD) 
    {
      $this->ManBD = $ManBD;
      
      $this->setarArrTabelas();
    }
    
    /**
     * obter o nome de todas as tabelas da base de dados selecionadas no JDBConn 
     * e jogar para $this->arrTabelas
     */
    private function setarArrTabelas()
    {
      $sql = "SELECT table_name 
                FROM information_schema.tables 
               WHERE table_schema = 'public' 
               ORDER BY 1";
              
      if($rs = $this->ManBD->objConn->Select($sql))
      {
        if ($rs->GetRowCount() > 0)
        {
          do
            $this->arrTabelas[] = $rs->GetField("table_name");
          while($rs->Next());
        }
      }
    }
    
    /** @return Array */
    public function obterArrTabelas()
    {
      return $this->arrTabelas;
    }
    
    /**
     * obter opçoes que serao utilizadas no formulario
     *  
     * @return Array 
     */
    public function obterArrOpTabelas()
    {
      $arrRetorno = array();
              
      foreach ($this->arrTabelas as $nmTabela)
        $arrRetorno[$nmTabela] = $this->obterNmClasse($nmTabela);
      
      return $arrRetorno;
    }
    
    /**
     * retorna o nome da classe atraves da tabela informada
     * 
     * @param string $nmTabela
     * @return string
     */
    public function obterNmClasse($nmTabela)
    {
      return implode("", array_map("ucfirst", explode("_", $nmTabela)));
    }
    
    /** 
     * Setar arrAtritutos e chavesPrimarias da tabela informada
     * 
     * @param string $nmTabela
     */
    public function setarDadosTabela($nmTabela)
    {
      $this->setarArrAtritutos($nmTabela);
      $this->setarArrChavesPrimarias($nmTabela);
      $this->setarArrConstraintCheck($nmTabela);
    }
    
    private function setarArrAtritutos($nmTabela)
    {
      $this->arrAtributos = array();
      
      $sql = "SELECT column_name, data_type, is_nullable, numeric_scale,
                     COALESCE(character_maximum_length, numeric_precision) as tamanho,
                     ' default ' || column_default                          as default
                FROM information_schema.columns  
               WHERE table_name = '$nmTabela' 
               ORDER BY 1";
              
      if($rs = $this->ManBD->objConn->Select($sql))
      {
        while (!$rs->IsEof())
        {
          $this->arrAtributos[$rs->GetField("column_name")] = array(
            "type"     => $rs->GetField("data_type"),
            "nullable" => $rs->GetField("is_nullable") == "NO" ? " not null" : "",
            "default"  => $rs->GetField("default"),
            "tamanho"  => null
          );
          
          $tamanho = $rs->GetField("tamanho");
          $precisao  = ifnull($rs->GetField("numeric_scale"), 0);
          
          if (str_value($tamanho))
          {
            if (str_value($tamanho) && $precisao != 0)
              $dsTamanho = "($tamanho, $precisao)";
            else
              $dsTamanho = "($tamanho)";
            
            $this->arrAtributos[$rs->GetField("column_name")]["tamanho"] = $dsTamanho;
          }
          
          $rs->Next();
        }
      }
    }
    
    private function setarArrChavesPrimarias($nmTabela)
    {
      $this->arrChavesPrimarias = array();
      
      $sql = "SELECT ccu.column_name
                FROM information_schema.table_constraints tc 
                JOIN information_schema.constraint_column_usage ccu USING(constraint_name)
               WHERE tc.constraint_type = 'PRIMARY KEY'
                 AND tc.table_name = '$nmTabela'
               ORDER BY 1";
              
      if($rs = $this->ManBD->objConn->Select($sql))
      {
        while (!$rs->IsEof())
        {
          $this->arrChavesPrimarias[] = $rs->GetField("column_name");
          
          $rs->Next();
        }
      }
    }
    
    private function setarArrConstraintCheck($nmTabela)
    {
      $this->arrConstraintCheck = array();
      
      $sql = "SELECT column_name, check_clause 
                FROM information_schema.constraint_column_usage ccu
                JOIN information_schema.check_constraints cc ON ccu.constraint_name = cc.constraint_name
               WHERE ccu.table_name = '$nmTabela'
               ORDER BY 1";
              
      if($rs = $this->ManBD->objConn->Select($sql))
      {
        while (!$rs->IsEof())
        {
          $column = $rs->GetField("column_name");
          $check  = $rs->GetField("check_clause");
          
          if (preg_match("/^[^<>]+$/", $check))
          {
            $retorno = array();

            preg_match_all("/((-)?\d+)/i", $check, $retorno);

            sort($retorno[0]);

            if (strpos($check, "IS NULL") !== false)
              $retorno[0] = array_unique(array_merge(array("NULL"), $retorno[0]));

            $this->arrConstraintCheck[$column] = $retorno[0];
          }
          
          $rs->Next();
        }
      }
    }
    
    /**
     * retorna array no formato  (atrituto => detalhes) 
     * de todos os atributos da tabela, que foram setados na ultima 
     * chamada de setarDadosTabela($nmTabela)
     * 
     * @return Array
     */
    public function obterArrAtributos()
    {
      return $this->arrAtributos;
    }
    
    /**
     * retorna array com todas as chaves primarias da tabela, setados na ultima 
     * chamada de setarDadosTabela($nmTabela)
     * 
     * @return Array
     */
    public function obterArrChavesPrimarias()
    {
      return $this->arrChavesPrimarias;
    }
    
    /**
     * retorna array com todos os ckeck da tabela, setados na ultima 
     * chamada de setarDadosTabela($nmTabela), utilizados para montar array OpId.. e constantes
     * 
     * @return Array
     */
    public function obterArrConstraintCheck()
    {
      return $this->arrConstraintCheck;
    }
  }
?>
