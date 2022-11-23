<?php
system("clear");
$array = array();

for($i = 0; $i <= 2; $i++) {
    $aluno = new stdClass();
    $aluno_readline = readline("Informe seu Nome:");
    $nota_readline  = readline("Informe sua Nota:");

    $aluno->nome = $aluno_readline;
    $aluno->nota = $nota_readline;
    array_push($array, $aluno);
    
}

$soma_das_notas = array_reduce($array, function($carry, $item)
{
    return $carry + $item->nota;
});

function max_in_array($array, $prop) {
  return max(array_column($array, $prop));
}



echo 'Maior nota: '.max_in_array($array, 'nota');
echo "Soma das notas:  ".$soma_das_notas;
echo "Media das notas: ".$soma_das_notas / count($array);



?>