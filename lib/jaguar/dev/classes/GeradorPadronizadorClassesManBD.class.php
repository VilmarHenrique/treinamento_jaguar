<?php
  class GeradorPadronizadorClassesManBD
  {
    /** @var ManBD */
    private $ManBD;
    
    /** @var MapeadorEntidadeBD */
    private $entidade;
    
    /** @var MapeadorClasseEntidade */
    private $classe;
    
    private $nmTabela = "";
    
    private $nmClasse = "";
    
    private $arrAtributosEntidade = array();
    
    private $dsCodigoFonte = "";
    
    private $dsLog = "";
    
    private $dsCaminhoClasses = "";
    
    private $nmArquivoAtual = "";
    
    public function __construct(ManBD $ManBD) 
    {
      $this->ManBD = $ManBD;
      
      $this->dsCaminhoClasses = JAGUAR_PATH . "../../" . (defined("CLASSES") ? CLASSES : "") . "classes";
      
      $this->entidade = new MapeadorEntidadeBD($this->ManBD);
    }
    
    public function obterDsLog()
    {
      return $this->dsLog;
    }
    
    public function obterOpNmTabelas()
    {
      return $this->entidade->obterArrOpTabelas();
    }
    
    public function gerarCodigoFonte(Array $arrTabela)
    {
      foreach ($arrTabela as $nmTabela) 
      {
        $this->dsCodigoFonte = "";
        
        try
        {
          $this->nmTabela       = $nmTabela;
          $this->nmClasse       = $this->entidade->obterNmClasse($nmTabela);
          $this->nmArquivoAtual = "$this->dsCaminhoClasses/$this->nmClasse.class.php";
          
          $this->dsLog .= "\n * $this->nmClasse\n";

          $this->entidade->setarDadosTabela($nmTabela);
          
          $this->ManBD->objErro->ds_aviso = "";
          
          $this->classe = new MapeadorClasseEntidade($this->ManBD, $this->nmClasse, array_keys($this->entidade->obterArrAtributos()), $this->entidade->obterArrConstraintCheck());
          
          $this->gerarCodigoArquivo();
          
          $this->dsLog .= $this->ManBD->objErro->ds_aviso;
          
          if(file_put_contents($this->nmArquivoAtual, $this->dsCodigoFonte) === false)
            throw new Exception("arquivo não pode ser gravado");
          elseif (count($this->classe->obterArrAtributos()) == 0)
            $this->dsLog .= "Arquivo $this->nmArquivoAtual criado com sucesso!\n";
          else
            $this->dsLog .= "Arquivo salvo com sucesso!\n";
          
          @chmod($this->nmArquivoAtual, 0777);
        }
        catch (Exception $e)
        {
          $this->dsLog .= "Erro: {$e->getMessage()}!\n";
        }
      }
    }
    
    private function gerarCodigoArquivo()
    {
      $extends = $implements = $comentario = "";
      
      if (str_value($this->classe->obterExtendsClasse()))
        $extends .= "extends " . $this->classe->obterExtendsClasse();
      
      if (str_value($this->classe->obterComentarioClasse()))
        $comentario .= $this->classe->obterComentarioClasse() . "\n";
      
      if (count($this->classe->obterArrImplementsInterfaces()) > 0)
        $implements .= "implements " . implode (", ", $this->classe->obterArrImplementsInterfaces());

      $this->dsCodigoFonte .= 
        "<?php\n".
           $comentario .
        "  class $this->nmClasse $extends $implements\n".
        "  {";
      
      $this->montarAtritutos();

      if (count($this->classe->obterArrConstantes()) > 0)
      {
        foreach ($this->classe->obterArrConstantes() as $nome => $valor)
          $this->dsCodigoFonte .= "\n    const $nome = $valor;\n";
      }
      
      $dsChavesPrimarias = "";
      
      if (count($this->entidade->obterArrChavesPrimarias()) > 0)
        $dsChavesPrimarias = implode("\", \"", $this->entidade->obterArrChavesPrimarias());
      elseif (count($this->classe->obterArrChavesPrimarias()) > 0)
        $dsChavesPrimarias = implode("\", \"", $this->classe->obterArrChavesPrimarias());
      else
        $this->dsLog .= "Atenção: entidade não possui chaves primarias!\n";
      
      $this->dsCodigoFonte .= "\n" .
        "    /** @var Array */\n".
        "    public \$key;\n\n".
        "    /** @var string */\n".
        "    public \$table;\n\n".
        "    /** @var JDBConn */\n".
        "    public \$objConn;\n\n".
        "    /** @param JDBConn */\n".
        "    public function __construct(JDBConn \$objConn)\n".
        "    {\n".
        "      \$this->objConn = \$objConn;\n".
        "      \$this->table   = \"$this->nmTabela\";\n".
        "      \$this->key     = array(\"$dsChavesPrimarias\");\n".
               $this->classe->obterCodigoExtraConstrutor() .
        "    }\n";

      $this->montarMetodos();
      
      $this->dsCodigoFonte .= 
        "  }\n".
        "?>";
    }
    
    private function montarAtritutos()
    {
      $this->arrAtributosEntidade = $this->entidade->obterArrAtributos();
      
      if (count($this->classe->obterArrAtributos()) > 0)
      {
        foreach ($this->classe->obterArrAtributos() as $nome => $value) 
        {
          if (in_array($nome, array("key", "table", "objConn")))
            continue;
        
          $this->dsCodigoFonte .= $this->retornarComentario($value);
          
          $this->dsCodigoFonte .= "\n    {$value["modificadores"]} \$$nome";

          if (str_value($value["valor"]))
            $this->dsCodigoFonte .= " = {$value["valor"]}";

          $this->dsCodigoFonte .= ";\n"; 
        }
      }
      else
      {
        ksort($this->arrAtributosEntidade);
        
        foreach ($this->arrAtributosEntidade as $nmAtributo => $dsAtributo) 
        {
          $this->dsCodigoFonte .= $this->retornarComentario(array("nome" => $nmAtributo, "isFromBD" => true));
          $this->dsCodigoFonte .= "\n    public \$$nmAtributo;\n";
        }
      }
    }
    
    private function montarMetodos()
    {  
      if (count($this->classe->obterArrMetodos()) > 0)
      {
        foreach ($this->classe->obterArrMetodos() as $nome => $value) 
        {
          if ($nome != "__construct")
          {
            if (str_value($value["comentario"]))
              $this->dsCodigoFonte .= "\n    ".$value["comentario"];

            $this->dsCodigoFonte .= "\n    {$value["modificadores"]} function $nome{$value["codigo"]}";
          }
        }
      }
    }
    
    private function retornarComentario(Array $dados)
    {
      if ($dados["isFromBD"])
      {
        $arrDadosAtributo = $this->arrAtributosEntidade[$dados["nome"]];
        
        if (in_array($arrDadosAtributo["type"], array("smallint", "integer", "bigint", "serial")))
          $tipo = "int";
        elseif (in_array($arrDadosAtributo["type"], array("double", "numeric", "real", "float")))
          $tipo = "float";
        elseif ($arrDadosAtributo["type"] == "boolean")
          $tipo = "bool";
        else
          $tipo = "string";
        
        $dsCampoBD = $arrDadosAtributo["type"].$arrDadosAtributo["tamanho"].$arrDadosAtributo["nullable"].$arrDadosAtributo["default"];
        
        $dsCampoBD = "\n     * <b>infoBD:</b> " . $dsCampoBD . "<br />\n     * @var $tipo\n     */"; 
        
        if (str_value($dados["comentario"]))
        {
          $comentario  = preg_replace("/\n(.)*(<b>infoBD:<\/b>|@var|\*\/)(.)*/", "", $dados["comentario"]);
          $comentario .= $dsCampoBD;
        }
        else
          $comentario = "/**$dsCampoBD";
      }
      elseif (str_value($dados["comentario"]))
        $comentario = preg_replace("/(.)*<b>info(BD|OP):<\/b>(.)*\n/", "", $dados["comentario"]);
      
      return (str_value($comentario) ? "\n    " . $comentario : "");
    }
  }
?>
