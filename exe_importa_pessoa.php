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
  $ds_arquivo = new JFormFile("f_ds_arquivo");
  $ds_arquivo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $form->AddObject($ds_arquivo);

  $form->OpenRow();
  $form->OpenHeader("", ["colspan" => 2]);
  $submit = new JFormSubmit("f_submit", "Enviar");
  $form->AddObject($submit);

  if ($form->IsSubmitted())
{
 
   $arr = file($_FILES["f_ds_arquivo"]["tmp_name"]);
    foreach ($arr as &$value){
      $explode = explode(";", $value);
      $nome  = $explode [0];
      $email = $explode[1]; 
      $telefone = $explode[2];
          
};

}

  $html->AddObject($form);

  echo $html->GetHtml();

  $conn->Close();