<?php
  class MapeadorClasseEntidade extends MapeadorClasse 
  {
    /** @var array */
    private $arrAtributosEntidadeBD = array();
    
    /** @var array */
    private $arrAtributosEntidadeClasse = array();
    
    /** @var array */
    private $arrConstraintCheck = array();
    
    /** @var string */
    private $dsCodigoExtraConstrutor = "";
    
    /** @var array */
    private $arrChavesPrimarias = array();
    
    /** @var ManBD */
    private $ManBD;

    /**
     * @param ManBD $ManBD
     * @param $nmClasse
     * @param array $arrAtributosBD
     * @param array $arrConstraintCheck
     * @throws Exception
     */
    public function __construct(ManBD $ManBD, $nmClasse, array $arrAtributosBD, array $arrConstraintCheck)
    {
      $this->ManBD     = $ManBD;
      $this->idOrdenar = false;
      $idOrdenar       = !(str_value($nmClasse) && class_exists($nmClasse));

      parent::__construct($nmClasse);
      
      if ($this->classe instanceof ReflectionClass)
      {
        $this->arrAtributosEntidadeBD = $arrAtributosBD;
        $this->arrConstraintCheck     = $arrConstraintCheck;

        $this->setarDadosClasseEntidade();

        $this->idOrdenar = $idOrdenar;
        $this->ordenarArrDados();
        
        $this->setarDadosConstrutor();
      }
    }
    
    public function obterArrChavesPrimarias()
    {
      return $this->arrChavesPrimarias;
    }
    
    public function obterCodigoExtraConstrutor()
    {
      return $this->dsCodigoExtraConstrutor;
    }
    
    private function setarDadosClasseEntidade()
    {
      $arrAtributosNovo = array();
      
      foreach ($this->arrAtributos as $key => $atributo)
      {
        if (strpos($atributo["nome"], "_") == 2)
          $this->arrAtributosEntidadeClasse[] = $atributo["nome"];
        
        $isFromDB = in_array($atributo["nome"], $this->arrAtributosEntidadeBD);
        
        $atributo["isFromBD"] = (bool) $isFromDB;
        
        $newKey = ($isFromDB ? "1" : "2") . $key;
        
        $arrAtributosNovo[$newKey] = $atributo;
      }
      
      $this->arrAtributos        = $arrAtributosNovo;
      $arrAtributosAcrescentados = array_diff($this->arrAtributosEntidadeBD, $this->arrAtributosEntidadeClasse);
      
      if (count($arrAtributosAcrescentados) > 0)
      {
        $this->ManBD->objErro->ds_aviso .= "Foram Acrescentados: " . implode(", ", $arrAtributosAcrescentados) . "!\n";
        
        foreach ($arrAtributosAcrescentados as $nome)
        {
          $this->arrAtributos["110256$nome"] = array(
            "nome"          => $nome,
            "modificadores" => "public",
            "isFromBD"      => true
          );
        }
      }
      
      $arrAtributosRetirados = array_diff($this->arrAtributosEntidadeClasse, $this->arrAtributosEntidadeBD);
      
      if (count($arrAtributosRetirados) > 0)
        $this->ManBD->objErro->ds_aviso .= "Foram Retirados do BD: " . implode(", ", $arrAtributosRetirados) . "!\n";
    }
    
    private function setarDadosConstrutor()
    {
      $this->dsCodigoExtraConstrutor = "";
      $this->arrChavesPrimarias = array();
      
      if (isset($this->arrMetodos["__construct"]))
      {
        $codigo = $this->arrMetodos["__construct"]["codigo"];
        $codigo = preg_replace("/\}[\s\n]*$/", "", end(preg_split("/\)[\s\n]*\{/", $codigo, 2)));
        $codigo = preg_replace("/\s+[\$]this->(objConn|table|key)(.*)/", "", $codigo);
        $codigo = trim($codigo, " \t\n");

        $obj = new $this->classe->name($this->ManBD->objConn);

        if (!($obj instanceof $this->classe->name))
          throw new Exception("classe esta com erros e não pode ser instânciada");
        
        if (str_value($codigo))
          $this->dsCodigoExtraConstrutor = "\n      $codigo\n";
        
        if ($this->arrAtributos["key"]["modificadores"] == "public" && is_array($obj->key) && count($obj->key) > 0)
          $this->arrChavesPrimarias = $obj->key;
      }
    }
  }