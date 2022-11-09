<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
 
  //Html
  $man = new JMaintenance($conn, "Manutenção de Cidade");
  $man->SetDBTable("cidade");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_cidade
  $cd_uf = new JFormHidden("f_cd_cidade");
  $man->AddDBField("cd_cidade", $cd_uf, false, true);
  
  //nm_cidade
  $label = "Nome";
  $nm_uf = new JFormText("f_nm_cidade");
  $nm_uf->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_cidade", $nm_uf, "<b>{$label}</b>");
 
  $label = "UF";
  $cd_uf = new JFormSelect("f_ds_sigla");
  $cd_uf->SetTestIfEmpty(true, "Selecione o campo {$label}!");
  $cd_uf->SetFirstEmpty();
  
  $sql =
    "SELECT u.cd_uf AS value, u.ds_sigla AS description
       FROM uf u
      ORDER BY u.ds_sigla";
  
  if ($rs = $conn->Select($sql))
  {
    $cd_uf->SetOptions($rs->GetArray(true));
  }
  else
    conn_mostra_erro();

  $man->AddDBField("cd_uf", $cd_uf, "<b>{$label}</b>");

  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_cidade.php\">Listagem de Cidades</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();