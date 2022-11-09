<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
 
  //Html
  $man = new JMaintenance($conn, "Manutenção de Estado");
  $man->SetDBTable("uf");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_regiao
  $cd_uf = new JFormHidden("f_cd_uf");
  $man->AddDBField("cd_uf", $cd_uf, false, true);
  
  //nm_regiao
  $label = "Estado";
  $nm_uf = new JFormText("f_nm_uf");
  $nm_uf->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_uf", $nm_uf, "<b>{$label}</b>");
  
  $label = "Sigla";
  $ds_sigla = new JFormText("f_ds_sigla");
  $ds_sigla->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("ds_sigla", $ds_sigla, "<b>{$label}</b>");

  $label = "País";
  $cd_pais = new JFormSelect("f_cd_pais");
  $cd_pais->SetTestIfEmpty(true, "Selecione o campo {$label}!");
  $cd_pais->SetFirstEmpty();
  
  $sql =
    "SELECT p.cd_pais AS value, p.nm_pais AS description
       FROM pais p
      ORDER BY p.nm_pais";
  
  if ($rs = $conn->Select($sql))
  {
    $cd_pais->SetOptions($rs->GetArray(true));
  }
  else
    conn_mostra_erro();

  $man->AddDBField("cd_pais", $cd_pais, "<b>{$label}</b>");

  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_uf.php\">Listagem de Estados</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();