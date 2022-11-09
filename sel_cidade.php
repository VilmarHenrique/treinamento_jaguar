<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  
  //Html
  $title = "Listagem de Cidades";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "c.cd_cidade, c.nm_cidade, u.ds_sigla, p.nm_pais"; //Select
  $sql["from"]   = "cidade c
                    JOIN uf u ON c.cd_uf = u.cd_uf
                    JOIN pais p ON p.cd_pais = u.cd_pais";
  $sql["count"]  = "c.cd_cidade";
  $sql["order"]  = "c.cd_cidade"; //Order By
  
  //Grid
  $grid_cidade = new JDBGrid("cidade", $conn, $sql);
  
  $visible_fields = [
    "cd_cidade" => "Código",
    "nm_cidade" => "Nome",
    "ds_sigla"  => "UF",
    "nm_pais"   => "País",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_cidade->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_cidade->SetColumnAlign("cd_cidade", "right");
  $grid_cidade->SetColumnAlign("ds_sigla",  "center");
  
  //Propriedades
  $grid_cidade->AddExtraFields([" " => "Propriedades"]);
  $grid_cidade->SetLink($nr_fields, "man_cidade.php");
  $grid_cidade->SetLinkFields($nr_fields, ["f_cd_cidade" => "cd_cidade"]);
  
  //Filtros
  $grid_cidade->AddFilterField("c.cd_cidade", "Código", "number", "=",  "cd_cidade");
  $grid_cidade->AddFilterField("nm_cidade",   "Nome",   "text",   "~*", "nm_cidade", false, false);
  $grid_cidade->AddFilterField("ds_sigla",    "Sigla",  "text",   "~*", "ds_sigla",  false, false);
  $grid_cidade->AddFilterField("nm_pais",     "País",   "text",   "~*", "nm_pais",   false, true, ["colspan" => 5]);
  
  //FilterProperties
  $grid_cidade->SetFilterProperties("nm_cidade", ["SetSize" => 30]);
  $grid_cidade->SetFilterProperties("ds_sigla",  ["SetMaxlength" => 2]); 
  
  $html->AddObject($grid_cidade);
  
  $html->AddHtml("<br><a href=\"man_cidade.php\">Adicionar Cidade</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();
  
