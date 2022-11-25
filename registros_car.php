<?php
system("clear");

$arr_carro = [];

$arr_carro[] = [
  "nr_registro" => 0,
  "modelo"      => "Uno",
  "fabricante"  => "Fiat",
  "cor"         => "prata",
  "portas"      => "4",
  "ano"         => "2014"
];

$arr_carro[] = [
  "nr_registro" => 1,
  "modelo"      => "Fiesta",
  "fabricante"  => "Ford",
  "cor"         => "preto",
  "portas"      => "2",
  "ano"         => "2015"
];

$arr_carro[] = [
  "nr_registro" => 2,
  "modelo"      => "Doblo",
  "fabricante"  => "Fiat",
  "cor"         => "verde",
  "portas"      => "4",
  "ano"         => "2013"
];

$arr_carro[] = [
  "nr_registro" => 3,
  "modelo"      => "Celta",
  "fabricante"  => "GM",
  "cor"         => "preto",
  "portas"      => "2",
  "ano"         => "2012"
];

$arr_carro[] = [
  "nr_registro" => 4,
  "modelo"      => "March",
  "fabricante"  => "Nissan",
  "cor"         => "prata",
  "portas"      => "2",
  "ano"         => "2015"
];

$arr_carro[] = [
  "nr_registro" => 5,
  "modelo"      => "Corsa",
  "fabricante"  => "GM",
  "cor"         => "branco",
  "portas"      => "2",
  "ano"         => "2010"
];

$arr_carro[] = [
  "nr_registro" => 6,
  "modelo"      => "Ranger",
  "fabricante"  => "Ford",
  "cor"         => "prata",
  "portas"      => "4",
  "ano"         => "2012"
];

$arr_carro[] = [
  "nr_registro" => 7,
  "modelo"      => "Trail Blazer",
  "fabricante"  => "GM",
  "cor"         => "branco",
  "portas"      => "4",
  "ano"         => "2014"
];

$arr_carro[] = [
  "nr_registro" => 8,
  "modelo"      => "Ecosport",
  "fabricante"  => "Ford",
  "cor"         => "preto",
  "portas"      => "4",
  "ano"         => "2013"
];

$arr_carro[] = [
  "nr_registro" => 9,
  "modelo"      => "Tucson",
  "fabricante"  => "Hyundai",
  "cor"         => "vinho",
  "portas"      => "4",
  "ano"         => "2012"
];
 print_r($arr_carro);

 foreach($arr_carro as $chave => $valor)
 {
  if(
    $valor["fabricante"] === "Ford"
    
  )
  echo $valor["modelo"];


 }





     










