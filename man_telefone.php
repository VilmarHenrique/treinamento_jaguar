<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_pessoa = $f_cd_pessoa;
   include("md_pessoa.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Telefone");
  $man->SetDBTable("telefone");
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_pessoa" => $f_cd_pessoa);
  $man->SetLocation("insert", "man_telefone.php", $key);
  $man->SetLocation("delete", "man_telefone.php", $key);
  $man->SetLocation("update", "man_telefone.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_pessoa))
  {
    $sql =
      "SELECT cd_pessoa, nm_pessoa
         FROM pessoa t
         WHERE cd_pessoa = {$f_cd_pessoa}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pessoa</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pessoa")} / {$rs->GetField("nm_pessoa")}</b>");
    }
    else
      conn_mostra_erro();
  }
  
  //cd_telefone
  $cd_telefone = new JFormHidden("f_cd_telefone");
  $man->AddDBField("cd_telefone", $cd_telefone, false, true);

  //cd_pessoa
  $cd_pessoa = new JFormHidden("f_cd_pessoa");
  $man->AddDBField("cd_pessoa", $cd_pessoa, false);
  
  //nr_telefone
  $label = "Telefone";
  $nr_telefone = new JFormFone("f_nr_telefone");
  $nr_telefone->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nr_telefone", $nr_telefone, "<b>{$label}</b>");

  //id_tipo
  $label = "Tipo";
  $id_tipo = new JFormSelect("f_id_tipo");
  $id_tipo->SetOptions($op_id_tipo_telefone);
  $id_tipo->SetFirstEmpty();
  $id_tipo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("id_tipo", $id_tipo, "<b>{$label}</b>");

  //id_principal
  $label = "Principal";
  $id_principal = new JFormSelect("f_id_principal");
  $id_principal->SetOptions($op_id_sim_nao);
  $id_principal->SetFirstEmpty();
  $id_principal->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("id_principal", $id_principal, "<b>{$label}</b>");
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br>");
  
  //Sql
  $sql = [];
  $sql["fields"] = "cd_pessoa, nr_telefone, id_principal, id_tipo";
  $sql["from"]   = "telefone";
  $sql["order"]  = "id_principal DESC";
  $sql["where"]  = "cd_pessoa = '{$f_cd_pessoa}' ";
    
  //Grid
  $grid_telefone = new JDBGrid("telefone_{$f_cd_pessoa}", $conn, $sql);
  
  $visible_fields = [
    "nr_telefone"     => "Telefone",
    "id_principal"    => "Principal",
    "id_tipo"         => "Tipo",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_telefone->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_telefone->SetColumnAlign("id_principal", "center");
  $grid_telefone->SetColumnAlign("id_tipo",      "center");

  //Callback
  $grid_telefone->SetCallback(get_index_of($visible_fields, "nr_telefone"), "Format_Fone", ["sys", "pt_BR"]);
  $grid_telefone->SetCallback(get_index_of($visible_fields, "id_principal"), "formata_id_sim_nao");
  $grid_telefone->SetCallback(get_index_of($visible_fields, "id_tipo"), "formata_id_tipo_telefone");
  
  //Propriedades
  $grid_telefone->AddExtraFields(array(" " => "Propriedades"));
  $grid_telefone->SetLink($nr_fields, "man_telefone.php");
  $grid_telefone->SetLinkFields($nr_fields, ["f_cd_telefone"  => "cd_telefone",
                                          "f_cd_pessoa" => "cd_pessoa"]);
  
  //Filtros
  $grid_telefone->AddFilterField("nr_telefone", "Telefone", "number", "=");
 
  $man->AddObject($grid_telefone);
  
  $man->AddHtml("<br><a href=\"sel_pessoa.php\">Listagem de Pessoas</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();