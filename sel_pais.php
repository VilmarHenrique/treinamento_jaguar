<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  //Html
  $title = "Listagem de Países";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "p.cd_pais, p.nm_pais"; //Select
  $sql["count"]  = "p.cd_pais";
  $sql["from"]   = "pais p"; //From
  $sql["order"]  = "p.cd_pais"; //Order By
  
  //Grid
  $grid_pais = new JDBGrid("pais", $conn, $sql);
  
  $visible_fields = [
    "cd_pais" => "Código",
    "nm_pais" => "País",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_pais->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_pais->SetColumnAlign("cd_regiao", "right");
  
  //Propriedades
  $grid_pais->AddExtraFields([" " => "Propriedades"]);
  $grid_pais->SetLink($nr_fields, "man_pais.php");
  $grid_pais->SetLinkFields($nr_fields, ["f_cd_pais" => "cd_pais"]);
  
  //Filtros
  $grid_pais->AddFilterField("cd_pais", "Código", "number", "=",  "cd_pais");
  $grid_pais->AddFilterField("nm_pais", "País", "text",   "~*", "nm_pais", false, false);
  
  //FilterProperties
  $grid_pais->SetFilterProperties("nm_pais", ["SetSize" => 30]);
  
  $html->AddObject($grid_pais);
  
  $html->AddHtml("<br><a href=\"man_pais.php\">Adicionar País</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();