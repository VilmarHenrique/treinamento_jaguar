<?php
  session_start();
  require_once '../lib/jaguar/jaguar.inc.php';
  require_once '../include/funcoes.inc.php';

  JDBAuth::SetValidated();

function envia_pedido($dados)
{

$dados = json_encode($dados);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.0.35/api/upvendas/index.php/v2/efesus/pedido',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $dados,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ZWNvbW1lcmNlOiFFb2ZlcnRhbyQj',
    'Content-Type: application/json',
    'Cookie: PHPSESSID=n2hb3seojd7l9d2rotd5n0q6b5'
  ),
));

$response = curl_exec($curl);

echo "\r\n" . curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);
echo $response;
}

if (($handle = fopen("PEDIDOS_1711.csv", "r")) !== FALSE) 
{
  $cd_cliente_old = null;

  while (($data = fgetcsv($handle, 0, ";")) !== FALSE) 
  {
    $cd_vendedor      = trim($data[0]);
    $cd_cliente       = trim($data[1]);
    $cd_tipo_pgto     = 5; //trim($data[2]);
    $cd_condicao_pgto = 1; //trim($data[3]);
    $cd_produto       = trim($data[4]);
    $cd_unidade       = trim($data[5]);
    $qt_produto       = trim($data[6]);
    $vl_produto       = trim($data[7]);
    $cd_carga         = trim($data[8]);

    if (!is_numeric($cd_vendedor))
      continue;

    if ($cd_cliente != $cd_cliente_old)
    {
      if (!is_null($cd_cliente_old))
        envia_pedido($arr_pedido);

      $sql = "SELECT obtem_cnpj_cpf({$cd_cliente}) AS nr_cnpj";

      if ($rs = $conn->Select($sql))
      {
        if (!$rs->GetRowCount())
		exit("\r\n{$cd_cliente}\r\n");

        $arr_pedido = [];
	$arr_pedido["nr_cnpj"]               = $rs->GetField("nr_cnpj");
	$arr_pedido["cd_tipo_pagamento"]     = $cd_tipo_pgto;
        $arr_pedido["cd_condicao_pagamento"] = $cd_condicao_pgto;	
	$arr_pedido["cd_carga"]              = $cd_carga;
	$arr_pedido["cd_vendedor"]           = $cd_vendedor;
	$arr_pedido["dt_pedido"]             = date("d/m/Y");

	$arr_pedido["produtos"][] = [
          "cd_produto" => $cd_produto,
	  "cd_unidade" => $cd_unidade,
	  "qt_produto" => $qt_produto,
	  "vl_produto" => Format_Number($vl_produto, 2, "pt_BR", "sys")
	];
      }
      else
        conn_mostra_erro();
    }
    else
    {
      $arr_pedido["produtos"][] = [
        "cd_produto" => $cd_produto,
	"cd_unidade" => $cd_unidade,
	"qt_produto" => $qt_produto,
	"vl_produto" => Format_Number($vl_produto, 2, "pt_BR", "sys")
      ];
    }

    $cd_cliente_old = $cd_cliente;
  }

  //Envia último pedido
  envia_pedido($arr_pedido);

  fclose($handle);
}