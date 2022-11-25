<?php

$arr_pessoa = [];

  //Leio os registros e armazeno no array "$arr_pessoa"
  for ($i = 1; $i <= 3; $i++)
  {
    $arr_pessoa[$i] = [
      "nome" => readline("Informe o nome: "),
      "idade" => readline("Informe a idade: ")
    ];
  }

  foreach($arr_pessoa as $id => $dados)
  {
    if ($dados["idade"] >= 18)
    {
      echo $dados["nome"]."tem 18 anos."."\r\n";
    }
    else
    {
      echo $dados["nome"]."nao tem 18 anos.". "\r\n";

    }
   
  }









/* Faça um programa que lê o nome e a idade de 5 pessoas e 
depois mostre o nome das quais tem mais de 18 anos */