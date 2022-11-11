<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Relatório de Pessoa";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");

  $conn->SetDebug(0);

  //Form
  $form = new JForm();


  
  //id_formato
  $label = "Formato";
  $form->OpenRow();
  $form->OpenHeader("<b>{$label}</b>");
  $form->OpenCell();
  $id_formato = new JFormSelect("f_id_formato");
  $id_formato->SetFirstEmpty();
  $id_formato->SetTestIfEmpty(true, "Preencha o campo $label!");
  $id_formato->SetOptions($op_id_formato);
  $form->AddObject($id_formato);

  $form->OpenRow();
  $form->OpenHeader("", ["colspan" => 2]);
  $submit = new JFormSubmit("f_submit", "Gerar");
  $form->AddObject($submit);

  $html->AddObject($form);

  echo $html->GetHtml();

  $conn->Close();
