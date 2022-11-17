<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_veiculo = $f_cd_veiculo;
   include("md_veiculo.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Motorista");
  $man->SetDBTable("veiculo_motorista");
  $man->SetInsertKeys(true);
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_veiculo" => $f_cd_veiculo);
  $man->SetLocation("insert", "man_veiculo_motorista.php", $key); 
  $man->SetLocation("delete", "man_veiculo_motorista.php", $key);
  $man->SetLocation("update", "man_veiculo_motorista.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_veiculo))
  {
    $sql =
      "SELECT v.cd_veiculo, v.ds_veiculo, v.ds_placa
         FROM veiculo v
         WHERE v.cd_veiculo = {$f_cd_veiculo}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Veículo</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_veiculo")} / {$rs->GetField("ds_veiculo")}</b>");
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Placa</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("ds_placa")}</b>");  
         
    }
    else
      conn_mostra_erro();
  }
  //Fields

  //cd_veiculo
  $cd_veiculo = new JFormHidden("f_cd_veiculo");
  $man->AddDBField("cd_veiculo", $cd_veiculo, false, true);

  //cd_pessoa
  $label = "Pessoa";
  $cd_pessoa = new JFormSelect("f_cd_pessoa");
  $cd_pessoa->SetTestIfEmpty(true, "Selecione o campo {$label}!");
  $cd_pessoa->SetFirstEmpty();
  
  $sql =
    "SELECT p.cd_pessoa AS value, p.nm_pessoa AS description
       FROM pessoa p
      ORDER BY p.nm_pessoa";
  
  if ($rs = $conn->Select($sql))
  {
    $cd_pessoa->SetOptions($rs->GetArray(true));
  }
  else
    conn_mostra_erro();
  $man->AddDBField("cd_pessoa", $cd_pessoa, "<b>{$label}</b>");

  //dt_vigencia
  $label = "Dt.Vigência";
  $dt_vigencia = new JFormDate("f_dt_vigencia"); 
  $dt_vigencia->SetTestIfEmpty(true,"Preencha o campo {$label}!");
  $man->AddDBField("dt_vigencia", $dt_vigencia, "<b>{$label}</b>",true);

  //man End
  $man->BuildEndMaintenance();

  $man->AddHtml("<br>");

  //Sql
  $sql = [];
  $sql["fields"] = "cd_veiculo, dt_vigencia,
                      TO_CHAR(dt_vigencia, 'DD/MM/YYYY') AS dt_vigencia_fmt,
                      nm_pessoa";
  $sql["from"]   = "veiculo_motorista vm
                    JOIN pessoa p ON p.cd_pessoa = vm.cd_pessoa";
  $sql["order"]  = "cd_veiculo";
  $sql["where"]  = "vm.cd_veiculo = '{$f_cd_veiculo}' ";

  //Grid
  $grid_veiculo_motorista = new JDBGrid("veiculo_{$f_cd_veiculo}", $conn, $sql);

  $visible_fields = [
    "dt_vigencia" => "Dt. Vigência",
    "nm_pessoa"   => "Pessoa",
  ];
    
  $nr_fields = sizeof($visible_fields);
    
  $grid_veiculo_motorista->SetVisibleFields($visible_fields);
    
  //ColumnAlign
  $grid_veiculo_motorista->SetColumnAlign("dt_vigencia", "center");

  //Callback
  $grid_veiculo_motorista->SetCallback(get_index_of($visible_fields, "dt_vigencia"), "Format_Date",   ["sys", "pt_BR"]);
      
  //Propriedades
  $grid_veiculo_motorista->AddExtraFields(array(" " => "Propriedades"));
  $grid_veiculo_motorista->SetLink($nr_fields, "man_veiculo_motorista.php");
  $grid_veiculo_motorista->SetLinkFields($nr_fields, ["f_cd_veiculo"  => "cd_veiculo",
                                            "f_dt_vigencia" => "dt_vigencia_fmt"]);

  $man->AddObject($grid_veiculo_motorista);
  
  $man->AddHtml("<br><a href=\"sel_veiculo.php\">Listagem de Veículo</a>");
    
  echo $man->GetHtml();
    
  $conn->Close();
 ?>