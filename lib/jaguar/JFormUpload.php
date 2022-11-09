<?php
  class JFormUpload extends JFormObject
  {
    /**
     * Stores object's type
     * @var string
     */
    var $mType = "Upload";

    /**
     * Stores error message
     * @var string
     */
    var $mError = "Valor Inválido!";

    /**
     * Determina os tipos de arquivos aceitos
     * @var string
     */
    var $mAcceptedFiles = ".jpg,.jpeg,.png,.pdf";

    /**
     * Determina o tamanho maximo do arquivo em MB
     * @var int
     */
    var $mMaxFileSize = 2;

    /**
     * Determina a quantidade de arquivos
     * @var int
     */
    var $mMaxFiles = 1;

    /**
     * Seta se os botões Enviar e Limpar serão mostrados
     * @var bool
     */
    var $mShowUploadButton = true;

    /**
     * Seta se as dicas do componente serão mostradas, pode ser passado um boolean, que se for true ira mostrar as dicas padrão,
     * ou um Array com as dicas
     * @var bool
     */
    var $mShowTips = false;

    const SECRET = "u6Ae0DZQb94SAZdVw74ydYt5P4ih3FNByg34gorC";

    const DIR_TMP = "/tmp/upload/";

    /**
     * Constructor
     *
     * @param string $name Field's name
     *
     */
    public function __construct($name)
    {
      $this->SetName($name);
      $this->mEmpty = $this->IsEmpty();
      $this->mMaxFileSize = substr(ini_get("upload_max_filesize"), 0, -1);

      JObject::$useComponents = true;
    }

    /**
     * Retorna arquivos
     * @return array
     */
    public function GetFiles()
    {
      $arrFiles = array();

      foreach (ifnull(json_decode($this->mValue), array()) as $token)
        $arrFiles[] = Firebase\JWT\JWT::decode($token, self::SECRET, array('HS256'));

      return $arrFiles;
    }

    /**
     * Seta tipos dos arquivos aceitos
     * @param string $acceptedFiles
     */
    public function SetAcceptedFiles($acceptedFiles)
    {
      $this->mAcceptedFiles = $acceptedFiles;
    }

    /**
     * Seta se os botões Enviar e Limpar serão mostrados
     * @var bool
     */
    public function ShowUploadButton($showUploadButton)
    {
      $this->mShowUploadButton = $showUploadButton;
    }

    /**
     * Seta se as dicas do componente serão mostradas, pode ser passado um boolean, que se for true ira mostrar as dicas padrão,
     * ou um Array com as dicas
     * @var bool
     */
    public function SetShowTips($showTips)
    {
      $this->mShowTips = $showTips;
    }

    /**
     * Seta tamanho maximo dos arquivos em MB
     * @param int $fileSize
     */
    public function SetFileSize($fileSize)
    {
      $this->mMaxFileSize = $fileSize;
    }

    /**
     * Seta maximo de arquivos que pode ser feito o upload
     * @param int $maxFiles
     */
    public function SetMaxFiles($maxFiles)
    {
      $this->mMaxFiles = $maxFiles;
    }

    /**
     * Builds object's output
     * @returns string
     */
    public function GetHtml()
    {
      $out  = "\n";
      $token = Firebase\JWT\JWT::encode(array("campo"            => $this->mName,
                                              "acceptedfiles"    => $this->mAcceptedFiles,
                                              "filesize"         => $this->mMaxFileSize,
                                              "maxfiles"         => $this->mMaxFiles,
                                              "showuploadbutton" => $this->mShowUploadButton,
                                              "showtips"         => $this->mShowTips), self::SECRET, 'HS256');

      $out .= "<jc-campo-upload token=\"{$token}\"></jc-campo-upload>";
      $out .= "<input class='".$this->MakeClass()."' id=\"".$this->mName."\" type=\"hidden\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
      $out .= " $this->mExtra>\n";

      return $this->GetRawHtml($out);
    }
  }
