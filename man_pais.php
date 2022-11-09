<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
   
  //Html
  $man = new JMaintenance($conn, "Manutenção de País");
  $man->SetDBTable("pais");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_regiao
  $cd_pais = new JFormHidden("f_cd_pais");
  $man->AddDBField("cd_pais", $cd_pais, false, true);
  
  //nm_regiao
  $label = "Nome";
  $nm_pais = new JFormText("f_nm_pais");
  $nm_pais->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_pais", $nm_pais, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_pais.php\">Listagem de Países</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();