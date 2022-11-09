<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_pessoa = $f_cd_pessoa;
  include("md_pessoa.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de E-mail");
  $man->SetDBTable("email");
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_pessoa" => $f_cd_pessoa);
  $man->SetLocation("insert", "man_email.php", $key);
  $man->SetLocation("delete", "man_email.php", $key);
  $man->SetLocation("update", "man_email.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_pessoa))
  {
    $sql =
      "SELECT p.cd_pessoa, p.nm_pessoa
         FROM pessoa p
        WHERE p.cd_pessoa = {$f_cd_pessoa}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pessoa</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pessoa")} / {$rs->GetField("nm_pessoa")}</b>");
    }
    else
      conn_mostra_erro();
  }
  
  //cd_email
  $cd_email = new JFormHidden("f_cd_email");
  $man->AddDBField("cd_email", $cd_email, false, true);

  //cd_pessoa
  $cd_pessoa = new JFormHidden("f_cd_pessoa");
  $man->AddDBField("cd_pessoa", $cd_pessoa, false);
  
  //ds_email
  $label = "E-mail";
  $ds_email = new JFormEmail("f_ds_email");
  $ds_email->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("ds_email", $ds_email, "<b>{$label}</b>");

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
  $sql["fields"] = "cd_pessoa, ds_email, id_principal, cd_email";
  $sql["from"]   = "email";
  $sql["order"]  = "id_principal DESC";
  $sql["where"]  = "cd_pessoa = '{$f_cd_pessoa}' ";
    
  //Grid
  $grid_email = new JDBGrid("email_{$f_cd_pessoa}", $conn, $sql);
  
  $visible_fields = [
    "ds_email"     => "E-mail",
    "id_principal" => "Principal",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_email->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_email->SetColumnAlign("id_principal", "center");

  //Callback
  $grid_email->SetCallback(get_index_of($visible_fields, "id_principal"), "formata_id_sim_nao");
  
  //Propriedades
  $grid_email->AddExtraFields(array(" " => "Propriedades"));
  $grid_email->SetLink($nr_fields, "man_email.php");
  $grid_email->SetLinkFields($nr_fields, ["f_cd_email"  => "cd_email",
                                          "f_cd_pessoa" => "cd_pessoa"]);
  
  //Filtros
  $grid_email->AddFilterField("ds_email", "E-mail", "text", "~*");
 
  $man->AddObject($grid_email);
  
  $man->AddHtml("<br><a href=\"sel_pessoa.php\">Listagem de Pessoas</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();