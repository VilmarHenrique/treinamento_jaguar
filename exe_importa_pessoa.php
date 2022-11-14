<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Importação de Pessoas";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
 
  $conn->SetDebug(0);

  //Form
  $form = new JForm();

  $label = "Nome";
  $form->OpenRow();
  $form->OpenHeader("Arquivo");
  $form->OpenCell();
  $nm_regiao = new JFormFile("f_nm_regiao");
  $nm_regiao->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $form->AddObject($nm_regiao);


  if ($form->IsSubmitted())
  {
    //Ler o arquivo e mostrar os registros na tela
    
  }

  $html->AddObject($form);

  echo $html->GetHtml();

  $conn->Close();