<?php

include("IXR_Library.inc.php");

function WriteLogRpc($args)
{
  $ret  = false;
  $str  = $args[0];
  $path = $args[1];

  if (!is_dir($path . "log"))
  {
    if (!@mkdir($path . "log", 0777))
      $ret = "Nao foi possivel criar o diretório: $path/log/";
  }

#    $ret = $path . " - " . $str;

  if (($handler = fopen($path . "/jaguar.log", "a")) != NULL)
  {
    if (fwrite($handler, "$str\n"))
    {
      fclose($handler);

      $ret = true;
    }
    else
      $ret = "Nao foi possivel escrever $str em $path/jaguar.log.";
  }
  else
    $ret =  "Não foi possível abrir o arquivo de log.";

  return $ret;
}

$server = new IXR_Server(array("demo.WriteLogRpc" => "WriteLogRpc"));

?>
