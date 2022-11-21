<?php

 $lines = file("SPEDFiscal93112282000108.txt");
 $c100Array = array();


 foreach ($lines as $line)
{
  $primeiros_digitos = substr($line, 1,4);
  if($primeiros_digitos === "C100") {
    $c100Array =  explode("|", $line);
    $chave = $c100Array[9];
    
    echo $chave . "\r\n";

  }
}
