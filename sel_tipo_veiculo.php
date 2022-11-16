<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  //Html
  $title = "Listagem de Tipos de Veículos";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "cd_tipo_veiculo, ds_tipo_veiculo";
  $sql["from"]   = "tipo_veiculo tv";
  $sql["order"]  = "cd_tipo_veiculo";
  
  //Grid
  $grid_tipo_veiculo = new JDBGrid("tipo_veiculo", $conn, $sql);
  
  $visible_fields = [
    "cd_tipo_veiculo"        => "Código",
    "ds_tipo_veiculo"   => "Descrição",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_tipo_veiculo->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_tipo_veiculo->SetColumnAlign("cd_tipo_veiculo", "right");
  
  //Propriedades
  $grid_tipo_veiculo->AddExtraFields([" " => "Propriedades"]);
  $grid_tipo_veiculo->SetLink($nr_fields, "man_tipo_veiculo.php");
  $grid_tipo_veiculo->SetLinkFields($nr_fields, ["f_cd_tipo_veiculo" => "cd_tipo_veiculo"]);
  
  //Filtros
  $grid_tipo_veiculo->AddFilterField("cd_tipo_veiculo", "Código",    "number", "=",  "cd_tipo_veiculo");
  $grid_tipo_veiculo->AddFilterField("ds_tipo_veiculo", "Descrição", "text",   "~*", "ds_tipo_veiculo", false, false);
  
  //FilterProperties
  $grid_tipo_veiculo->SetFilterProperties("ds_tipo_veiculo", ["SetSize" => 45]);
  
  $html->AddObject($grid_tipo_veiculo);
  
  $html->AddHtml("<br><a href=\"man_tipo_veiculo.php\">Adicionar Veículo</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();