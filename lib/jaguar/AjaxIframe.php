<?php
  session_start();
  require_once("jaguar.inc.php");

  if (file_exists("../../include/funcoes.inc.php"))
    require_once("../../include/funcoes.inc.php");
  elseif (file_exists("../../adm/include/funcoes.inc.php"))
    require_once("../../adm/include/funcoes.inc.php");

  JDBAuth::SetValidated();

  class AjaxIframe
  {
    public static function converterDadosISO(&$dados)
    {
      if (!is_bool($dados) && !is_array($dados) && !is_object($dados))
        $dados = utf8_decode($dados);
      else
        array_walk_recursive($dados, function (&$elem) {
          if (is_string($elem))
            $elem = utf8_decode($elem);
          if (is_object($elem))
            AjaxIframe::converterDadosISO($elem);
        });
    }

    public static function converterDadosUTF8(&$retorno)
    {
      if (is_bool($retorno))
        return;
      elseif (!is_array($retorno) && !is_object($retorno))
        $retorno = utf8_encode($retorno);
      else
        array_walk_recursive($retorno, function (&$elem) {
          if (is_string($elem))
            $elem = utf8_encode($elem);
          if (is_object($elem))
            AjaxIframe::converterDadosUTF8($elem);
        });
    }

    public static function apagarConnRecursivo(&$object)
    {
      if (!is_object($object) && !is_array($object)) return;

      if (is_object($object) && isset($object->objConn))
        $object->objConn = null;

      foreach ($object as $obj)
        AjaxIframe::apagarConnRecursivo($obj);
    }
  }

  error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_DEPRECATED);

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET,PUT,PATCH,POST,DELETE,OPTIONS");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    exit;

  try
  {
    if (!str_value($_REQUEST["c"]) || !str_value($_REQUEST["a"]))
      throw new Exception ("Erro classe ou ação não informados!");

    $className = ucwords($_REQUEST["c"]);
    $acao = $_REQUEST["a"];

    if (!class_exists($className))
      throw new Exception ("Erro Classe não existe!");

    if (!method_exists($className, $acao))
      throw new Exception ("Erro Método não existe!");

    $ReflectionMethod = new ReflectionMethod($className, $acao);

    if ($ReflectionMethod->isStatic())
      $class = $className;
    else
      $class = new $className(JDBConn::getInstance());

    $docComment = $ReflectionMethod->getDocComment();

    if (strpos($docComment, "@uses ajaxComplete") === false)
      throw new Exception ("Erro anotação uses não encontrada!");

    if (strpos($docComment, "@access public") === false && !str_value($_SESSION["s_cd_usuario"]))
    {
      if (method_exists("Usuario", "validarToken"))
        Usuario::validarToken();
      else
        throw new Exception("Você não está autenticado!", 403);
    }

    if ((int)$_REQUEST["t"]) // t === 'throws exception e altera http1.1 status'
    {
      $ManBD = ManBD::getInstance();
      $ManBD->mostrarErro     = false;
      $ManBD->throwExceptions = true;
    }

    $param = is_array($_REQUEST["p"]) ? $_REQUEST["p"] : array($_REQUEST["p"]);
    $arrFuncao = array($class, $acao);

    //AjaxIframe::converterDadosISO($param);

    $retorno = call_user_func_array($arrFuncao, $param);

    AjaxIframe::apagarConnRecursivo($retorno);
    AjaxIframe::converterDadosUTF8($retorno);
  }
  catch (Exception $e)
  {
    if ((int)$_REQUEST["t"] || $e->getCode())
    {
      $status = max($e->getCode(), 400); // Bad Request
      header("HTTP/1.1 {$status}");
    }

    $retorno = new stdClass();
    $retorno->status  = "ERRO";
    $retorno->erro    = utf8_encode($e->getMessage());
  }

  header('Content-Type: application/json');
  echo json_encode($retorno);
