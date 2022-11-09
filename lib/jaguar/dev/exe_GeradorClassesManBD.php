<?php
  session_start();
  require_once("../jaguar.inc.php");
  require_once("classes/MapeadorClasse.class.php");
  require_once("classes/MapeadorClasseEntidade.class.php");
  require_once("classes/MapeadorEntidadeBD.class.php");
  require_once("classes/GeradorPadronizadorClassesManBD.class.php");
  
  set_time_limit(0);
  ini_set("memory_limit", -1);
  
  JDBAuth::SetValidated();
  
  $titulo = "Gerador e Padronizador de Classes para ManBD";
  $html = new JHtml($titulo);
  $html->AddHtml("<h3>$titulo</h3>");

  $form = new JForm("gerador_classes");
  $form->SetAction("exe_GeradorClassesManBD.php");

  $GeradorClasses = new GeradorPadronizadorClassesManBD($ManBD);
  
  $form->OpenRow();
  $form->OpenCell();
  $nmTabela = new JFormDualList('f_nm_tabela');
  $nmTabela->SetOptions($GeradorClasses->obterOpNmTabelas());
  $form->AddObject($nmTabela);

  $form->OpenRow();
  $form->OpenHeader();
  $fSubmit = new JFormSubmit("f_submit", "Gerar");
  $form->AddObject($fSubmit);

  if ($form->IsSubmitted() && is_array($_REQUEST["f_nm_tabela_destination"]))
  {
    sort($_REQUEST["f_nm_tabela_destination"]);
    $GeradorClasses->gerarCodigoFonte($_REQUEST["f_nm_tabela_destination"]);
  }
  
  $form->OpenRow();
  $form->OpenCell();
  $fCodigo = new JFormTextArea('f_codido');
  $fCodigo->SetValue($GeradorClasses->obterDsLog());
  $fCodigo->SetSize(100, 13);
  $form->AddObject($fCodigo);

  $html->AddObject($form);
  
  echo $html->GetHtml();
?>
