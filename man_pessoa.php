<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
 
  $s_md_cd_pessoa = $f_cd_pessoa;
  include("md_pessoa.php");

  //Html
  $man = new JMaintenance($conn, "Manutenção de Pessoa");
  $man->SetDBTable("pessoa");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);
  
  //cd_pessoa
  $cd_pessoa = new JFormHidden("f_cd_pessoa");
  $man->AddDBField("cd_pessoa", $cd_pessoa, false, true);
  
  //nm_pessoa
  $label = "Nome";
  $nm_pessoa = new JFormText("f_nm_pessoa");
  $nm_pessoa->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_pessoa", $nm_pessoa, "<b>{$label}</b>");

  //dt_nascimento
  $label = "Data de Nascimento";
  $dt_nascimento = new JFormDate("f_dt_nascimento");
  $dt_nascimento->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("dt_nascimento", $dt_nascimento, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_pessoa.php\">Listagem de Pessoas</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();