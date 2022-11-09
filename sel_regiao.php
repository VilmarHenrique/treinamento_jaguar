<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  //Html
  $title = "Listagem de Regiões";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "r.cd_regiao, r.nm_regiao"; //Select
  $sql["count"]  = "r.cd_regiao";
  $sql["from"]   = "regiao r"; //From
  $sql["order"]  = "r.cd_regiao"; //Order By
  
  //Grid
  $grid_regiao = new JDBGrid("regiao", $conn, $sql);
  
  $visible_fields = [
    "cd_regiao" => "Código",
    "nm_regiao" => "Nome",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_regiao->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_regiao->SetColumnAlign("cd_regiao", "right");
  
  //Propriedades
  $grid_regiao->AddExtraFields([" " => "Propriedades"]);
  $grid_regiao->SetLink($nr_fields, "man_regiao.php");
  $grid_regiao->SetLinkFields($nr_fields, ["f_cd_regiao" => "cd_regiao"]);
  
  //Filtros
  $grid_regiao->AddFilterField("cd_regiao", "Código", "number", "=",  "cd_regiao");
  $grid_regiao->AddFilterField("nm_regiao", "Região", "text",   "~*", "nm_regiao", false, false);
  
  //FilterProperties
  $grid_regiao->SetFilterProperties("nm_regiao", ["SetSize" => 30]);
  
  $html->AddObject($grid_regiao);
  
  $html->AddHtml("<br><a href=\"man_regiao.php\">Adicionar Região</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();