<?php
/**
 * Está classe nunca poderá ser instanciada. Usar Autoload::init().
 */
final class Autoload
{

	/**
	 * Guarda uma instância da própria classe.
	 * @var Autoload
	 */
	private static $autoload;

  /**
   * Guarda o caminho padrão do diretório das classes
   * @var string
   */
  private $classDir;

  /**
   * Guarda o caminho base do diretório
   */
  private $baseDir;

	/**
	 * Registra o autoload.
	 */
	private function __construct()
  {
    $this->baseDir = JAGUAR_PATH . "../..";
    $this->classDir = array();

    $path_classes = "classes";

    if (defined("CLASSES"))
    {
      foreach (explode(";", CLASSES) as $path)
        $this->classDir[] = str_replace('//', '/', $this->baseDir . '/' . trim($path, '/') . '/' . $path_classes);
    }
    else
      $this->classDir[] = str_replace('//', '/', $this->baseDir . '/' . $path_classes);

    array_unique($this->classDir);

		spl_autoload_extensions('.php');
		spl_autoload_register(array ($this, 'loader'));
	}

  private function lerDir(&$arrDirs, $dir)
  {
    if (!is_dir($dir)) return;

    $arrDirs[] = $dir;

    foreach (scandir($dir) as $arq)
    {
      if ($arq[0] != '.' && $arq != 'CVS' && is_dir($dir . '/' . $arq))
        $this->lerDir($arrDirs, $dir . '/' . $arq);
    }
  }

	/**
	 * Configurações do autoload.
	 */
	private function loader($className)
  {
    $arrDirs = array();

    /**
     * por razões de compatibilidade com versão antiga do Autoload
     */
    if (!isset($_SESSION["autoLoaderDirs"]) || !is_array($_SESSION["autoLoaderDirs"]))
      $_SESSION["autoLoaderDirs"] = array();

    if (!isset($_SESSION["autoLoaderDirs"][$this->baseDir]))
    {
      foreach ($this->classDir as $classDir)
        $this->lerDir($arrDirs, $classDir);

      $_SESSION["autoLoaderDirs"][$this->baseDir] = json_encode($arrDirs);
    }

    if (is_string($_SESSION["autoLoaderDirs"][$this->baseDir]))
      $arrDirs = json_decode($_SESSION["autoLoaderDirs"][$this->baseDir]);
    else
      return;

    if (!is_array($arrDirs)) return;

    foreach ($arrDirs as $dir)
    {
      if (file_exists($dir . '/' . $className . '.class.php'))
      {
        require_once($dir . '/' . $className . '.class.php');
        return;
      }
    }
	}


	/**
	 * Inicia o autoload se o mesmo já não estiver iniciado.
	 */
	public static function init()
  {
		if (!isset(self::$autoload))
			self::$autoload = new Autoload();
	}
}

Autoload::init();

?>
