<?php
  class JGridAngular extends JObject
  {
    /**
     * Stores object's type
     * @var string
     */
    var $mType = "GridAngular";

    /**
     * Stores error message
     * @var string
     */
    var $mError = "Valor Inválido!";

    /**
     * Array com as colunas e suas opções
     * Ex.: array(array("label" => "Label", "campo" => "nmCampo", "width" => prWidth, "tipo" => "texto"))
     * @var array
     */
    var $mColunas;

    /**
     * Array com os dados e suas opções
     * array(array("nmCampo" => "vlCampo",  "nmCampo2" => "vlCampo2"), 
     *       array("nmCampo" => "vlCampo_", "nmCampo2" => "vlCampo2_"))
     * @var array
     */
    var $mDados;

    /**
     * Array com os campos com totalizadores
     * Ex.: {campo: nmCampo, tipo: numero}
     * @var array
     */
    var $mTotalizadores;
    
    /**
     * Placeholder para o campo de Pesquisa
     * @var string
     */
    var $dsPlaceHolder;

    /**
     * @var int
     */
    var $prHeight;

    /**
     * @var int
     */
    var $prWidth;

    /**
     * @var int
     */
    var $vlHeightOffset;

    /**
     * @var int
     */
    var $vlWidthOffset;

    /**
     * @var boolean
     */
    var $idAutosize;

    /**
     * @var boolean
     */
    var $idDebug;

    /**
     * JGridAngular constructor
     *
     * @param int $prHeight
     * @param int $prWidth
     * @param int $vlHeightOffset
     * @param int $vlWidthOffset
     */
    public function __construct($prHeight = 80, $prWidth = 80, $vlHeightOffset=0, $vlWidthOffset=0)
    {
      parent::__construct();

      $this->prHeight       = $prHeight;
      $this->prWidth        = $prWidth;
      $this->vlHeightOffset = $vlHeightOffset;
      $this->vlWidthOffset  = $vlWidthOffset;
      $this->idAutosize     = true;
      $this->idDebug        = false;
      $this->mColunas       = "[]";
      $this->mDados         = "[]";
      $this->dsPlaceHolder  = "Pesquisar";

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
     * @param array $mColunas
     */
    public function SetColunas($mColunas)
    {
      if (is_array($mColunas) && sizeof($mColunas)) 
      {
        converteRetornoUTF8($mColunas);
        $this->mColunas = strtr(json_encode($mColunas), "'\"", "\\''");
      }
    }

    /**
     * @param array $mDados
     */
    public function SetDados($mDados)
    {
      if (is_array($mDados) && sizeof($mDados)) 
      {
        converteRetornoUTF8($mDados);
        $this->mDados = str_replace("\"", "'", str_replace("'", "\\'", json_encode($mDados)));
      }
    }

    /**
     * @param array $mTotalizadores
     */
    public function SetTotalizadores($mTotalizadores = array())
    {
      $this->mTotalizadores = str_replace("\"", "'", str_replace("'", "\\'", json_encode($mTotalizadores)));
    }

    /**
     * Builds object's output
     * @returns string
     */
    public function GetHtml()
    {
      $out  = "\n";
      $out .= "<jc-grid colunas=\"{$this->mColunas}\"
                        dados=\"{$this->mDados}\"
                        totalizadores=\"{$this->mTotalizadores}\"
                        placeholder=\"{$this->dsPlaceHolder}\"
                        height=\"{$this->prHeight}\"
                        width=\"{$this->prWidth}\"
                        height-offset=\"{$this->vlHeightOffset}\"
                        width-offset=\"{$this->vlWidthOffset}\"
                        id-autosize=\"{$this->idAutosize}\"
                        debug=\"{$this->idDebug}\" {$this->mExtra}>
               </jc-grid>";

      return (string) $out;
    }
  }
