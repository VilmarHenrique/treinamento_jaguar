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
  $form->AddFunction("abre_relatorio_");
  $form->SetTarget("relatorio");
  $form->SetAction(REL_SUBMIT);

  //cd_cidade
  $label = "Cidade";
  $form->OpenRow();
  $form->OpenHeader("<b>{$label}</b>");
  $form->OpenCell();
  $cd_cidade = new JFormDualList("f_cd_cidade");
   
  $sql = <<<SQL
   SELECT c.cd_cidade AS value,
		      c.nm_cidade ||' / ' || u.ds_sigla AS description 
      FROM cidade c  
      JOIN uf u on c.cd_uf = u.cd_uf 
      ORDER BY c.cd_cidade 
SQL;
 
  if ($rs = $conn->Select($sql))
  $cd_cidade->SetOptions($rs->GetArray(true));
  else
  conn_mostra_erro();

  $form->AddObject($cd_cidade);

//Bairro
  $label = "Bairro";
  $form->OpenRow();
  $form->OpenHeader("<b>{$label}</b>");
  $form->OpenCell();
  $nm_bairro = new JFormText("f_nm_bairro");
  $nm_bairro->SetTestIfEmpty(true, "Preencha o campo $label!");
  $form->AddObject($nm_bairro);
   
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
