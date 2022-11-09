<?php
  class JFormAutoComplete extends JFormText
  {
    /**
     * Stores object's type
     * @var string
     */
    var $mType = "AutoComplete";

    /**
     * Stores error message
     * @var string
     */
    var $mError     = "Valor Inválido!";

    /**
     * Classe que será utilizada para buscar dados
     * @var string
     */
    var $classe;

    /**
     * Método que retornará os valores do autocomplete
     * @var string
     */
    var $metodo;

    /**
     * Placeholder para o campo
     * @var string
     */
    var $dsPlaceHolder;

    /**
     * @var array
     */
    var $mParams;

    /**
     * @var int
     */
    var $mMinCharacteres = 2;

    /**
     * @var int
     */
    var $mDelay = 400;

    /**
     * @var json
     */
    var $mItens;

    /**
     * Constructor
     *
     * @param string $name Field's name
     * @param        $classe
     * @param        $metodo
     */
    public function __construct($name, $classe, $metodo, $mOptions = array())
    {
      $this->SetName($name);
      $this->mEmpty          = $this->IsEmpty();
      $this->classe          = $classe;
      $this->metodo          = $metodo;
      $this->mMinCharacteres = $this->mLazy ? $this->mMinCharacteres : 0;
      $this->SetMinCharacteres(2);

      if (count($mOptions))
      {
        $this->SetMinCharacteres(0);
        $this->SetOptions($mOptions);
      }

      JObject::$useComponents = true;
    }

    /**
     * Seta o placeholder
     * @param string $dsPlaceHolder
     */
    public function SetPlaceHolder($dsPlaceHolder = null)
    {
      $this->dsPlaceHolder = $dsPlaceHolder;
    }

    /**
     * @param int $value
     * @internal string $description
     */
    public function SetDefaultValue($value = false)
    {
      $args        = func_get_args();
      $description = $args[1];
      
      if (!str_value($value) || !str_value($description)) return;

      $this->mDefaultValue = "{value: {$value}, description: '{$description}'}";
    }

    /**
     * Seta valor
     * @param int $value
     */
    public function SetValue($value = false)
    {
      if (!$value) return;

      $ReflectionMethod = new ReflectionMethod($this->classe, $this->metodo);

      if ($ReflectionMethod->isStatic())
        $class = $this->classe;
      else
        $class = new $this->classe(JDBConn::getInstance());

      $arrFuncao = array($class, $this->metodo);
      $item = current(call_user_func_array($arrFuncao, array('', array("value" => $value))));

      $this->SetDefaultValue($item["value"], $item["description"]);
    }

    private function SetOptions($mParams = array())
    {
      $ReflectionMethod = new ReflectionMethod($this->classe, $this->metodo);

      if ($ReflectionMethod->isStatic())
        $class = $this->classe;
      else
        $class = new $this->classe(JDBConn::getInstance());

      $arrFuncao = array($class, $this->metodo);

      $retorno = call_user_func_array($arrFuncao, array('', $mParams));

      converteRetornoUTF8($retorno);

      $this->mItens = strtr(json_encode($retorno), "'\"", "\\''");
    }

    /**
     * Ex: array("limit" => 10, "id_ativo" => true, "ds_cidade" => "Lagoa Vermelha / RS")
     * @param array $mParams
     */
    public function SetParams($mParams = array())
    {
      converteRetornoUTF8($mParams);
      $this->mParams = strtr(json_encode($mParams), "'\"", "\\''");
    }

    /**
     * Seta a quantidade mínima de caracteres para a busca
     * @param int $min
     */
    public function SetMinCharacteres($min)
    {
      $this->mMinCharacteres = (int)$min;
    }

    /**
     * Seta delay para começar a consulta
     * @param int $delay
     */
    public function SetDelay($delay)
    {
      $this->mDelay = (int)$delay;
    }

    /**
     * Builds object's output
     * @returns string
     */
    public function GetHtml()
    {
      $out  = "\n";
      $out .= "<jc-campo-autocomplete campo=\"{$this->mName}\"
                                      classe=\"{$this->classe}\"
                                      metodo=\"{$this->metodo}\"
                                      params=\"{$this->mParams}\"
                                      item=\"{$this->mDefaultValue}\"
                                      itens=\"{$this->mItens}\"
                                      min-characteres=\"{$this->mMinCharacteres}\"
                                      delay=\"{$this->mDelay}\"
                                      placeholder=\"{$this->dsPlaceHolder} \">
               </jc-campo-autocomplete>";
      $out .= "<input class='".$this->MakeClass()."' id=\"".$this->mName."\" type=\"hidden\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
      $out .= " $this->mExtra>\n";

      return $this->GetRawHtml($out);
    }
  }
