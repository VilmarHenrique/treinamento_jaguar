<?php
 require_once("lib/jaguar/jaguar.inc.php");
 

 $lines = file("SPEDFiscal93112282000108.txt");

 $arr_notas = [];
 
 foreach ($lines as $line)
 {
  $allc100 = substr($line, 1,4);

  if ($allc100 === "C100") 
  {
    $c100Array = explode("|", $line);
    $chave = $c100Array[9];
    $valor = Format_Number($c100Array[12], 2, "pt_BR", "sys");
    
    $arr_notas[$chave] = $valor; 
  }
} 
/* $valor = array_sum($arr_notas); */
   
print_r($arr_notas);


