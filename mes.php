<?php

//armazeno no array "arr_mes" os meses do ano
$arr_mes = [
  "janeiro", "fevereio", "marco", 
  "abril", "maio", "junho", 
  "julho", "agosto", "setembro", 
  "outubro", "novembro", "dezembro"
];

 $nr = readline("Digite um numero do mes do ano:");

 echo "o mes eh " . $arr_mes[$nr-1];