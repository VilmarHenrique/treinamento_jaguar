<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");

   //Html
   $title = "Formulário HTML";
   $html = new JHtml($title);
   $html->AddHtml("<h3>$title</h3>");

   $form = new JForm();
   $form->AddFunction("abre_formulario_");
   $form->SetTarget("formulario");

   $label = "Nome";
   $form->OpenRow();
   $form->OpenHeader("<b>{$label}</b>");
   $form->OpenCell();
   $nome = new JFormText("f_nome");
   $nome->SetTestIfEmpty(true, "Preencha o campo $label!");
   $form->AddObject($nome);
   
   $label = "Data Nascimento";
   $form->OpenRow();
   $form->OpenHeader("<b>{$label}</b>");
   $form->OpenCell();
   $data = new JFormDate("f_data");
   $data->SetTestIfEmpty(true, "Preencha o campo $label!");
   $form->AddObject($data);

   $form->OpenRow();
   $form->OpenHeader("", ["colspan" => 2]);
   $submit = new JFormSubmit("f_submit", "Enviar");
   $form->AddObject($submit);


   $html->AddObject($form);


   echo $html->GetHtml();

  

