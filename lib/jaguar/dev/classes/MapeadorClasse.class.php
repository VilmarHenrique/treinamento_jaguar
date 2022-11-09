<?php
  class MapeadorClasse 
  {
    /** @var ReflectionClass */
    protected $classe;
    
    protected $arrTxtArquivo;
    
    protected $dsComentario = "";
    
    protected $nmExtendsClass = "";
    
    protected $arrImplementsInterfaces = array();
    
    protected $arrAtributos = array();
    
    protected $arrConstantes = array();
    
    protected $arrMetodos = array();
    
    protected $idOrdenar = false;
    
    /**
     * @param string $nmClasse
     */
    public function __construct($nmClasse)
    {
      if (str_value($nmClasse) && class_exists($nmClasse))
      {
        $this->classe = new ReflectionClass($nmClasse);

        $this->arrTxtArquivo = file($this->classe->getFileName());
        
        $this->setarDadosEscopo();
        $this->setarDadosAtritutos();
        
        $this->setarDadosConstantes();
        $this->setarDadosMetodos();
        
        $this->ordenarArrDados($this->idOrdenar);
      }
    }
    
    /** @return string */
    public function obterComentarioClasse()
    {
      return $this->dsComentario;
    }
    
    /** @return string */
    public function obterExtendsClasse()
    {
      return $this->nmExtendsClass;
    }
    
    /** @return array */
    public function obterArrImplementsInterfaces()
    {
      return $this->arrImplementsInterfaces;
    }
    
    /**
     * retorna array com todos os atribudos no formato 
     * ("nome" => array("nome" => ,"comentario" => ,"valor" => ,"modificadores"=> ,"isFromBD" => ))
     * 
     * @return array
     */
    public function obterArrAtributos()
    {
      return $this->arrAtributos;
    }
    
    /**
     * retorna array com todos os constantes no formato 
     * ("nome" => "valor")
     * 
     * @return array
     */
    public function obterArrConstantes()
    {
      return $this->arrConstantes;
    }
    
    /**
     * retorna array com todos os metodos no formato 
     * ("nome" => array("nome" => , "comentario" => , "codigo" => ,"modificadores" => ))
     * 
     * @return array
     */
    public function obterArrMetodos()
    {
      return $this->arrMetodos;
    }
    
    protected function setarDadosEscopo()
    {
      $this->dsComentario = $this->classe->getDocComment();
      $this->arrImplementsInterfaces = $this->classe->getInterfaceNames();

      $parentClass = $this->classe->getParentClass();
      
      if ($parentClass instanceof ReflectionClass)
        $this->nmExtendsClass = $parentClass->getName();
    }
    
    protected function setarDadosAtritutos()
    {
      $arrValores = $this->classe->getDefaultProperties();
      
      foreach ($this->classe->getProperties() as $atributo)
      {
        if ($atributo->getDeclaringClass()->getName() != $this->classe->getName())
          continue;
        
        $key  = ($atributo->isStatic() ? "2" : "1");
        $key .= str_pad($atributo->getModifiers(), 4, "0", STR_PAD_LEFT);
        $key .= $atributo->getName();
        
        $valor = $arrValores[$atributo->getName()];
        
        if (gettype($valor) == "string")
          $valor = "\"$valor\"";
        elseif (gettype($valor) == "array")
          $valor = $this->obterCodigoArray($atributo->getName());
        elseif (str_value($valor))
          $valor = implode("\n    ", explode("\n", var_export($valor, true)));
        
        $this->arrAtributos[$key] = array(
          "nome"          => $atributo->getName(),
          "comentario"    => $atributo->getDocComment(),
          "valor"         => $valor,
          "modificadores" => $this->obterModificadores($atributo->getModifiers())
        );
      }
    }
    
    protected function setarDadosConstantes()
    {
      foreach ($this->classe->getConstants() as $nome => $valor)
      {
        if (gettype($valor) == "string")
          $valor = "\"$valor\"";
          
        $this->arrConstantes[$nome] = $valor;
      }
    }
    
    protected function setarDadosMetodos()
    {
      foreach ($this->classe->getMethods() as $metodo)
      { 
        if ($metodo->getDeclaringClass()->getName() != $this->classe->getName())
          continue;
        
        // modificador alterado, pois no caso dos metodos o valor vem multiplicado por algum fator ainda desconhecido
        $modificador = $metodo->getModifiers() % 1024;
        
        if ($modificador < 8)
          $modificador = 1024 + $modificador;
        
        $nome = ($metodo->GetName() == $this->classe->getName() ? "__construct" : $metodo->GetName());
        
        $key = ($metodo->isStatic() ? "2" : "1") . str_pad($modificador, 4, "0", STR_PAD_LEFT) . $nome;
        
        $codigo = implode("", array_slice($this->arrTxtArquivo, $metodo->getStartLine() - 1, $metodo->getEndLine() - $metodo->getStartLine() + 1));
        
        $this->arrMetodos[$key] = array(
          "nome"          => $nome,
          "comentario"    => $metodo->getDocComment(),
          "codigo"        => substr($codigo, strpos($codigo, "(")),
          "modificadores" => $this->obterModificadores($modificador)
        );
      }
    }
    
    protected function ordenarArrDados($idAjustarNome=true)
    {
      if ($idAjustarNome)
      {
        foreach (array("arrAtributos", "arrMetodos") as $var) {
          if ($this->idOrdenar)
            ksort($this->$var);

          $arrNovo = array();

          foreach ($this->$var as $arrDados)
            $arrNovo[$arrDados["nome"]] = $arrDados;

          $this->$var = $arrNovo;
        }
      }
    }
    
    protected function obterModificadores($modificador)
    {
      $arrModificadores = array();
      
      if ($modificador >= 1024)
      {
        $modificador -= 1024;
        $arrModificadores[] = "protected";
      }
      if ($modificador >= 512)
      {
        $modificador -= 512;
        $arrModificadores[] = "protected";
      }
      if ($modificador >= 256)
      {
        $modificador -= 256;
        $arrModificadores[] = "public";
      }
      if ($modificador >= 4)
      {
        $modificador -= 4;
        $arrModificadores[] = "final";
      }
      if ($modificador >= 2)
      {
        $modificador -= 2;
        $arrModificadores[] = "abstract";
      }
      if ($modificador == 1)
      {
        $arrModificadores[] = "static";
      }  
      
      return implode(" ", $arrModificadores);
    }
    
    private function obterCodigoArray($nmProperty)
    {
      $arrMatches = array();
      
      preg_match("/$nmProperty\s*=\s*array\s*\([^;]*\);/i", implode("", $this->arrTxtArquivo), $arrMatches);
      
      return preg_replace("/(^$nmProperty\s*=\s*|;$)/", "", $arrMatches[0]);
    }
  }
?>
