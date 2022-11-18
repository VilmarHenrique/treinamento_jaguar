<?php

 $lines = file("SPEDFiscal93112282000108.txt");
 $c100Array = array();
 
foreach ($lines as $line)
{
  $primeiros_digitos = substr($line, 1,4);
  if($primeiros_digitos === "C100") {


      $remove_um = str_replace("|", "", $line);
      $remove_dois = str_replace(",", "", $remove_um);
      $remove_c100 = str_replace('C100', '', $remove_dois);


      $primeiro_44 = substr($remove_c100, 0,44);

      array_push($c100Array,$primeiro_44 );
  }
}

print_r($c100Array);

