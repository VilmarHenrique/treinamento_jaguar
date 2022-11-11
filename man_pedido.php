<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  $s_md_cd_produto = $f_cd_produto;
  include("md_pedido.php");

  //Html
  $man = new JMaintenance($conn, "Manutenção de Pedido");
  $man->SetDBTable("pedido");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);

  //cd_pedido
  $cd_pedido = new JFormHidden("f_cd_pedido");
  $man->AddDBField("cd_pedido", $cd_pedido, false, true);

  //cd_pessoa
  $label = "Pessoa";
  $cd_pessoa = new JFormSelect("f_cd_pessoa");
  $cd_pessoa->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $cd_pessoa->SetFirstEmpty();
    
  $sql = <<<SQL
    SELECT p.cd_pessoa AS value,
           p.cd_pessoa ||' / '|| p.nm_pessoa AS description
      FROM pessoa p
      ORDER BY p.cd_pessoa
SQL;
  
  if ($rs = $conn->Select($sql))
    $cd_pessoa->SetOptions($rs->GetArray(true));
  else
    conn_mostra_erro();
  
  $man->AddDBField("cd_pessoa", $cd_pessoa, "<b>{$label}</b>");

  //dt_pedido
  $label = "Data";
  $dt_pedido = new JFormDate("f_dt_pedido"); 
  $dt_pedido->SetTestIfEmpty(true,"Preencha o campo {$label}!");
  $man->AddDBField("dt_pedido", $dt_pedido, "<b>{$label}</b>"); 
 
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_pedido.php\">Novo pedido</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();