<?php
    $arr_numeros = [];
    $countpositivo = 0;
    $countnegativo = 0;
    $countpar      = 0;
    $countimpar    = 0;
        
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

?>
