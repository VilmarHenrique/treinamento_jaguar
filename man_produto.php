<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  $s_md_cd_pessoa = $f_cd_pessoa;
  include("md_pessoa.php");

  //Html
  $man = new JMaintenance($conn, "Manutenção de Produto");
  $man->SetDBTable("produto");
  $man->AddMasterDetail($master);
  
  $conn->SetDebug(0);

  //cd_produto
  $cd_produto = new JFormHidden("f_cd_produto");
  $man->AddDBField("cd_produto", $cd_produto, false, true);

  //nm_produto
  $label = "Nome";
  $nm_produto = new JFormText("f_nm_produto");
  $nm_produto->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nm_produto", $nm_produto, "<b>{$label}</b>");

  //id_ativo
  $label = "Ativo";
  $id_ativo = new JFormSelect("f_id_ativo");
  $id_ativo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $id_ativo->SetOptions($op_id_sim_nao);
  $id_ativo->SetFirstEmpty();
  $man->AddDBField("id_ativo", $id_ativo, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_produto.php\">Listagem de Produto</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();