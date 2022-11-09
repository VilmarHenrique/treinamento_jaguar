<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  $s_md_cd_regiao = $f_cd_regiao;
  include("md_regiao.php");
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Região");
  $man->SetDBTable("regiao");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_regiao
  $cd_regiao = new JFormHidden("f_cd_regiao");
  $man->AddDBField("cd_regiao", $cd_regiao, false, true);
  
  //nm_regiao
  $label = "Nome";
  $nm_regiao = new JFormText("f_nm_regiao");
  $nm_regiao->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_regiao", $nm_regiao, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_regiao.php\">Listagem de Regiões</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();