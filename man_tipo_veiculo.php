<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
   
  //Html
  $man = new JMaintenance($conn, "Manutenção de Tipo de Veículo");
  $man->SetDBTable("tipo_veiculo");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_tipo_veiculo
  $cd_tipo_veiculo = new JFormHidden("f_cd_tipo_veiculo");
  $man->AddDBField("cd_tipo_veiculo", $cd_tipo_veiculo, false, true);
  
  //ds_tipo_veiculo
  $label = "Descrição";
  $ds_tipo_veiculo = new JFormText("f_ds_tipo_veiculo");
  $ds_tipo_veiculo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("ds_tipo_veiculo", $ds_tipo_veiculo, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_tipo_veiculo.php\">Listagem de Veículo</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();