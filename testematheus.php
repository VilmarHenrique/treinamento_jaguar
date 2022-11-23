<?php
  $arr_alunos = [];

  //Leio os registros e armazeno no array "$arr_alunos"
  for ($i = 1; $i <= 2; $i++)
  {
    $arr_alunos[$i] = [
      "nome" => readline("Informe o nome: "),
      "nota" => readline("Informe a nota: ")
    ];
  }

  $vl_total = 0;
  $vl_maior_nota = 0;
  $qt_alunos = 0;

  //Percorro o array "$arr_alunos"
  foreach ($arr_alunos as $chave => $dados)
  {
    $qt_alunos++;

    if ($dados["nota"] > $vl_maior_nota)
    {
      $vl_maior_nota = $dados["nota"];
      $indice_maior = $chave;
    }
    
    $vl_total += $dados["nota"];
  }

  $vl_media = $vl_total / $qt_alunos;
  $nm_aluno_maior = $arr_alunos[$indice_maior]["nome"];
  

  echo "Média: $vl_media / Maior: $vl_maior_nota / Aluno: {$nm_aluno_maior}";