<?php
    $arr_numeros = [];
    $countpositivo = 0;
    $countnegativo = 0;
    $countpar      = 0;
    $countimpar    = 0;


         
  //Leio os registros e armazeno no array "arr_numeros"
  for ($i = 1; $i <= 10; $i++)
  {
     $arr_numeros[$i] = readline("Informe 10 numeros:");
    if($arr_numeros[$i]>= 0){
      $countpositivo++;
    }
    else{
      $countnegativo++;
    }
    if($arr_numeros[$i]% 2 == 0){
      $countimpar++;
    }
    else{
      $countpar++;
    }
  }
   echo "positvos: $countpositivo / negativos: $countnegativo / par: $countimpar / impar: $countpar";




  




/* 
  Entre com 10 números e armazene em um array.
  Ao final o programa deverá mostrar:
  - quantos negativos foram digitados;
  - quantos positivos foram digitados;
  - quantos pares e ímpares.
 */










?>
