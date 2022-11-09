<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  //Html
  $title = "Listagem de Pessoas";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "p.cd_pessoa, p.nm_pessoa, p.dt_nascimento"; //Select
  $sql["from"]   = "pessoa p"; //FROM 
  $sql["count"]  = "p.cd_pessoa"; 
  $sql["order"]  = "p.cd_pessoa"; //Order By
  
  //Grid
  $grid_pessoa = new JDBGrid("pessoa", $conn, $sql);
  
  $visible_fields = [
    "cd_pessoa"      => "Código",
    "nm_pessoa"      => "Nome",
    "dt_nascimento"  => "Data de Nascimento",
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_pessoa->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_pessoa->SetColumnAlign("cd_pessoa",      "right");
  $grid_pessoa->SetColumnAlign("dt_nascimento",  "center");


  $grid_pessoa->SetCallback(get_index_of($visible_fields, "dt_nascimento"), "Format_Date", ["sys", "pt_BR"]);
  
  
  
  $grid_pessoa->AddExtraFields([" " => "Propriedades", "  " => "Extrato"]);
  
  //Propriedades
  $grid_pessoa->SetLink($nr_fields, "man_pessoa.php");
  $grid_pessoa->SetLinkFields($nr_fields, ["f_cd_pessoa" => "cd_pessoa"]);

  $grid_pessoa->SetLink($nr_fields + 1, "con_pessoa.php");
  $grid_pessoa->SetLinkFields($nr_fields + 1, ["f_cd_pessoa" => "cd_pessoa"]);
  
  //Filtros
  $grid_pessoa->AddFilterField("cd_pessoa", "Código", "number", "=",  "cd_pessoa");
  $grid_pessoa->AddFilterField("nm_pessoa",  "Nome",  "text",   "~*", "nm_cidade", false, false);
    
  //FilterProperties
  $grid_pessoa->SetFilterProperties("nm_pessoa", ["SetSize" => 30]);
  $grid_pessoa->SetFilterProperties("dt_nascimento",  ["SetSize" => 12]); 
  
  $html->AddObject($grid_pessoa);
  
  $html->AddHtml("<br><a href=\"man_pessoa.php\">Adicionar uma nova pessoa</a>");
  
  echo $html->GetHtml();
  
  $conn->Close();
  
