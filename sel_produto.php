<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  //Html
  $title = "Listagem de Produtos";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "cd_produto, nm_produto, id_ativo"; //Select
  $sql["from"]   = "produto"; //FROM 
  $sql["count"]  = "cd_produto"; 
  $sql["order"]  = "cd_produto"; //Order By

  //Grid
  $grid_produto = new JDBGrid("produto", $conn, $sql);
  
  $visible_fields = [
    "cd_produto"      => "Código",
    "nm_produto"      => "Nome",
    "id_ativo"        => "Ativo",
  ];
  
  $nr_fields = sizeof($visible_fields);

  $grid_produto->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_produto->SetColumnAlign("cd_produto", "right");
  $grid_produto->SetColumnAlign("id_ativo",   "center");
  
    //ExtraFields
  $grid_produto->AddExtraFields([" "  => "Propriedades"]);

  //Propriedades
  $grid_produto->SetLink($nr_fields, "man_produto.php");
  $grid_produto->SetLinkFields($nr_fields, ["f_cd_produto" => "cd_produto"]);
  
  //Filtros
  $grid_produto->AddFilterField("cd_produto", "Código", "number", "=",  "cd_produto");
  $grid_produto->AddFilterField("nm_produto", "Nome",   "text",   "~*", "nm_produto", false, false);
  
  //CallBack
  $grid_produto->SetCallback(get_index_of($visible_fields, "id_ativo"), "formata_id_sim_nao");
  
  //FilterProperties
  $grid_produto->SetFilterProperties("nm_produto", ["SetSize" => 30]);

  $html->AddObject($grid_produto);
  
  $html->AddHtml("<br><a href=\"man_produto.php\">Adicionar produto</a>");

  echo $html->GetHtml();
  
  $conn->Close();
