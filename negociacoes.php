<?php

session_start();
  require_once("lib/jaguar/jaguar.inc.php");

  $arr_arquivo = file("Negociacoes.csv");
 
  $arr_final = [];

  foreach($arr_arquivo as $chave => $dados)
  {
    $arr_valores    = explode(";", $dados);  
    $cd_negociacao  = $arr_valores[0];
    $cd_produto     = $arr_valores[1];         
   
    if (is_numeric($cd_negociacao) && is_numeric($cd_produto))
    {
     $arr_final[$cd_negociacao][] = $cd_produto; 
    }
      
  
  }
  print_r($arr_final);