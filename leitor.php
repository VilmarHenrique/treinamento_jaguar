<?php
system("clear");

for($i = 1; $i <= 3; $i++){
  $leitor[$i]= readline("Informe 10 valores: ");
}

for($i = 3; $i >= 1; $i--){
  echo $leitor[$i] . "\r\n";
}
