<?php

use Sirius\Validation\Rule\MaxLength;

  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  //Html
  $title = "Listagem de Estados";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "u.cd_uf, u.nm_uf, u.ds_sigla, p.nm_pais"; //Select
  $sql["from"]   = "uf u 
                    JOIN pais p on u.cd_pais = p.cd_pais";
  $sql["count"]  = "u.cd_uf";
  $sql["order"]  = "u.cd_uf"; //Order By
  
  //Grid
  $grid_uf = new JDBGrid("uf", $conn, $sql);
  
  $visible_fields = [
    "cd_uf" => "Código",
    "nm_uf" => "Estado",
    "ds_sigla"=> "Sigla",
    "nm_pais" => "País",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_uf->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_uf->SetColumnAlign("cd_uf", "right");
  $grid_uf->SetColumnAlign("ds_sigla", "center");
  
  //Propriedades
  $grid_uf->AddExtraFields([" " => "Propriedades"]);
  $grid_uf->SetLink($nr_fields, "man_uf.php");
  $grid_uf->SetLinkFields($nr_fields, ["f_cd_uf" => "cd_uf"]);
  
  //Filtros
  $grid_uf->AddFilterField("u.cd_uf", "Código", "number", "=",  "cd_uf");
  $grid_uf->AddFilterField("nm_uf", "Estado", "text",   "~*", "nm_uf", false, false);
  $grid_uf->AddFilterField("ds_sigla","Sigla","text", "~*", "ds_sigla", false, false);
  $grid_uf->AddFilterField("nm_pais", "País", "text", "~*", "nm_pais",false, true, ["colspan" => 5]);
  
  //FilterProperties
  $grid_uf->SetFilterProperties("nm_uf", ["SetSize" => 30]);
  $grid_uf->SetFilterProperties("ds_sigla", ["SetMaxlength" => 2]); 
  
  $html->AddObject($grid_uf);
  
  $html->AddHtml("<br><a href=\"man_uf.php\">Adicionar Estado</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();