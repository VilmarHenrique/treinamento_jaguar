<?php
  require_once("jaguar.inc.php");
  error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_DEPRECATED);

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET,PUT,PATCH,POST,DELETE,OPTIONS");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    exit;

  class UploadFile
  {
    public static function add($dsToken, array $arrArquivos)
    {
      $arrDados = Firebase\JWT\JWT::decode($dsToken, JFormUpload::SECRET, array("HS256"));

      $uploadHandler = new Sirius\Upload\Handler(JFormUpload::DIR_TMP);
      $uploadHandler->setAutoconfirm(true);
      $uploadHandler->addRule("extension", array("allowed" => str_replace(".", "", $arrDados->acceptedfiles)),
                              "Formato do arquivo é inválido.");
      $uploadHandler->addRule("size", "size=" . $arrDados->filesize . "M",
                              "Arquivo é muito grande. Tamanho maximo permitido: " . $arrDados->filesize . "MB.");
      $result = $uploadHandler->process($arrArquivos);

      $retorno = new stdClass();

      $retorno->teste = $arrDados;

      try
      {
        if (!$result->isValid())
          throw new Exception();

        foreach ($result as $file)
          $retorno->arquivos[] = Firebase\JWT\JWT::encode(array("nome"    => $file->name,
            "caminho" => JFormUpload::DIR_TMP . $file->name), JFormUpload::SECRET, "HS256");
      }
      catch (\Exception $e)
      {
        $result->clear();
        $retorno->status = "ERRO";

        foreach ($result as $file)
        {
          $msg_erro = "";

          foreach ($file->messages as $message)
            $msg_erro .= $message . "\n";

          $retorno->erro[] = array("arquivo" => $file->original_name, "erros" => utf8_encode($msg_erro));
        }
      }

      return $retorno;
    }

    public static function remove(array $arrDsToken)
    {
      foreach ($arrDsToken as $token)
      {
        $arrDados = Firebase\JWT\JWT::decode($token, JFormUpload::SECRET, array("HS256"));

        unlink($arrDados->caminho);
      }
    }
  }

  $retorno = new stdClass();

  try
  {
    switch ($_REQUEST["acao"])
    {
      case "add":
        $retorno = UploadFile::add($_REQUEST["token"], ifnull($_FILES["file"], array()));
      break;
      case "remove":
        UploadFile::remove(ifnull($_REQUEST["token"], array()));
      break;
    }

    if ($retorno->status === "ERRO")
      throw new Exception();
  }
  catch (Exception $e)
  {
    $retorno->status = "ERRO";

    if (!isset($retorno->erro))
      $retorno->erro = $e->getMessage();
  }

  header("Content-Type: application/json");
  echo json_encode($retorno);