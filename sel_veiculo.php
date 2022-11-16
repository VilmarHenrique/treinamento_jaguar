<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Listagem de Veículos";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "v.cd_veiculo, tv.cd_tipo_veiculo, tv.ds_tipo_veiculo, v.ds_placa, v.ds_veiculo,
                     v.nr_ano_fabricacao, v.nr_ano_modelo, v.id_ativo"; //Select
  $sql["count"]  = "v.cd_veiculo";
  $sql["from"]   = "veiculo v 
                    JOIN tipo_veiculo tv ON v.cd_tipo_veiculo = tv.cd_tipo_veiculo"; //From
  $sql["order"]  = "v.cd_veiculo"; //Order By
  
  //Grid
  $grid_veiculo = new JDBGrid("veiculo", $conn, $sql);
  
  $visible_fields = [
    "cd_veiculo"        => "Código",
    "ds_veiculo"        => "Descrição",
    "ds_placa"          => "Placa",
    "ds_tipo_veiculo"   => "Tipo",
    "nr_ano_fabricacao" => "Fab.",
    "nr_ano_modelo"     => "Modelo",
    "id_ativo"          => "Ativo",    
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_veiculo->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_veiculo->SetColumnAlign("cd_veiculo",        "right");
  $grid_veiculo->SetColumnAlign("ds_placa",          "center");
  $grid_veiculo->SetColumnAlign("nr_ano_fabricacao", "center");
  $grid_veiculo->SetColumnAlign("nr_ano_modelo",     "center");
  $grid_veiculo->SetColumnAlign("id_ativo",          "center");
 
  //Propriedades
  $grid_veiculo->AddExtraFields([" " => "Propriedades"]);
  $grid_veiculo->SetLink($nr_fields, "man_veiculo.php");
  $grid_veiculo->SetLinkFields($nr_fields, ["f_cd_veiculo" => "cd_veiculo"]);
  
  //Filtros
  $grid_veiculo->AddFilterField("cd_veiculo",      "Código",    "number", "=",  "cd_veiculo");
  $grid_veiculo->AddFilterField("ds_veiculo",      "Descrição", "text",   "~*", "ds_veiculo",false,false);
  $grid_veiculo->AddFilterField("cd_tipo_veiculo", "Tipo",      "number", "=",  "cd_tipo_veiculo",false,false);
  $grid_veiculo->AddFilterField("id_ativo",        "Ativo",     "select", "=",  "id_ativo", $op_id_sim_nao);
  
  //CallBack
  $grid_veiculo->SetCallback(get_index_of($visible_fields, "id_ativo"), "formata_id_sim_nao");
  $grid_veiculo->SetCallback(get_index_of($visible_fields, "ds_placa"), "Format_Placa", ["sys", "pt_BR"]);
    
  $html->AddObject($grid_veiculo);
  
  $html->AddHtml("<br><a href=\"man_veiculo.php\">Adicionar Veículos</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();