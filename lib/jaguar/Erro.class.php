<?php
  class Erro
  {
    public $ds_erro;

    public $ds_aviso;

    public $id_cancela_acao;

    /** @var JDBConn */
    public $objConn;
    
    private static $instance;

    public function __construct(JDBConn $conn)
    {
      $this->objConn = $conn;
    }
    
    /**
     * Singleton
     * @return Erro
     */
    public static final function getInstance()
    {
      if (isset(self::$instance))
        return self::$instance;

      if (defined("ERRBIT_HOST") && ERRBIT_HOST)
        self::utilizarErrbit();

      self::$instance = new Erro(JDBConn::getInstance());
      return self::$instance;
    }

    private static $errbitConfig;

    private static function utilizarErrbit()
    {
      $arrUrl = parse_url(ERRBIT_HOST);

      self::$errbitConfig = array(
        'api_key'          => ERRBIT_API_KEY_PHP,
        'host'             => $arrUrl["host"],
        'port'             => $arrUrl["port"],
        "secure"           => $arrUrl["scheme"] === "https",
        'controller'       => ifnull($_REQUEST["c"], basename($_SERVER["PHP_SELF"])),
        'action'           => ifnull($_REQUEST["a"], $_REQUEST["action"]),
        'parameters'       => ifnull($_REQUEST["p"], $_REQUEST),
        'session_data'     => array(),
        'cgi_data'         => array("cliente" => JDBConn::getInstance()->mDb, "usuario" => $_SESSION["s_cd_usuario"]),
        'environment_name' => 'production',
      );

      \Errbit\Errbit::instance()->configure(self::$errbitConfig);

      ErrorHandlers::register(\Errbit\Errbit::instance());
    }

    public static function enviarNotificacaoErrbit($dsErro, $config=array())
    {
      if (!self::$errbitConfig || !@get_headers(ERRBIT_HOST))
        return false;

      $defaultConfig = self::$errbitConfig;

      foreach ($config as $key => &$value)
        if (is_array($value))
          $value = array_merge(ifnull($defaultConfig[$key], array()), $value);

      \Errbit\Errbit::instance()->notify(new Exception(toUtf8(html_entity_decode($dsErro))), toUtf8($config));

      return true;
    }

    public static function obterHtmlErrbit()
    {
      if (!(self::$errbitConfig && defined("ERRBIT_API_KEY_JAVASCRIPT") && ERRBIT_API_KEY_JAVASCRIPT)) return "";

      $v = function($d) { return $d; };

      $js = <<<JS
        if (!window.onerror)
        {
          var airbrake = new airbrakeJs.Client({
            projectId: '{$v(ERRBIT_API_KEY_JAVASCRIPT)}',
            projectKey: '{$v(ERRBIT_API_KEY_JAVASCRIPT)}',
            reporter: 'xhr',
            host: '{$v(ERRBIT_HOST_HTTPS)}'
          });

          window.onerror = function (msg, url, line, col, error) {
            airbrake.notify({
              error: error,
              context: {$v(jsonEncode(array(
                "environment" => self::$errbitConfig["environment_name"],
                "controller"  => self::$errbitConfig["controller"],
                "action"      => self::$errbitConfig["action"]
              )))},
              environment: {$v(jsonEncode(self::$errbitConfig["cgi_data"]))},
              params: {$v(jsonEncode(self::$errbitConfig["parameters"]))},
              session: {$v(jsonEncode(self::$errbitConfig["session_data"]))},
            });
          }
        }
JS;

			return <<<HTML
			<script type="text/javascript" src="{$v(URL . "jaguar-ui/dist/jaguar.errbit.js")}"></script>
			<script type="text/javascript">{$js}</script>
HTML;
    }
  }

  if (class_exists("\\Errbit\\Handlers\\ErrorHandlers"))
  {
    class ErrorHandlers extends \Errbit\Handlers\ErrorHandlers
    {
      public static function register($errbit, $handlers = array('exception', 'error', 'fatal'))
      {
        new self($errbit, $handlers);
      }

      public function onError($code, $message, $file, $line)
      {
        global $conn;

        if (strpos($message, "pg_query()") !== false)
        {
          if (strpos($message, "commands ignored until end of transaction block") === false)
            Erro::enviarNotificacaoErrbit($message, array("cgi_data" => array("sql" => $conn->mDriver->mLastSql)));
        }
        elseif ($code !== E_WARNING)
          parent::onError($code, $message, $file, $line);
        else
        {
          if (PHP_MAJOR_VERSION >= 7 && strpos($message, 'Declaration of') !== false)
            parent::onError($code, $message, $file, $line);
        }
      }
      
      public function onException($exception)
      {
        echo "Exception: {$exception->getMessage()}";
        parent::onException($exception);
      }
    }
  }
  
  $Erro = Erro::getInstance();