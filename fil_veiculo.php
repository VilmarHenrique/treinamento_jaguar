<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Relatório de Veículos";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");

  $conn->SetDebug(0);

  //Form
  $form = new JForm();
  $form->AddFunction("abre_relatorio_");
  $form->SetTarget("relatorio");
  $form->SetAction(REL_SUBMIT);

  //cd_tipo_veiculo
  $form->OpenRow();
  $form->OpenHeader("Tipo");
  $form->OpenCell();
  $cd_tipo_veiculo = new JFormDualList("f_cd_tipo_veiculo");

  $sql = <<<SQL
    SELECT cd_tipo_veiculo AS value, ds_tipo_veiculo AS description
      FROM tipo_veiculo tv
     ORDER BY ds_tipo_veiculo
SQL;

  if ($rs = $conn->Select($sql))
    $cd_tipo_veiculo->SetOptions($rs->GetArray(true));
  else
    conn_mostra_erro();

  $form->AddObject($cd_tipo_veiculo);

  //id_ativo
  $form->OpenRow();
  $form->OpenHeader("Ativo");
  $form->OpenCell();
  $id_ativo = new JFormSelect("f_id_ativo");
  $id_ativo->SetFirstEmpty();
  $id_ativo->SetOptions($op_id_sim_nao);
  $form->AddObject($id_ativo);
   
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
