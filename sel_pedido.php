<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  //Html
  $title = "Listagem de Pedidos";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  $conn->SetDebug(0);
  
  //Sql
  $sql = [];
  $sql["fields"] = "p.cd_pedido, p2.nm_pessoa, p.dt_pedido, p.vl_pedido"; //Select
  $sql["from"]   = "pedido p
                    JOIN pessoa p2 ON p2.cd_pessoa = p.cd_pessoa"; //FROM 
  $sql["count"]  = "cd_pedido"; 
  $sql["order"]  = "p.cd_pedido"; //Order By

  //Grid
  $grid_pedido = new JDBGrid("pedido", $conn, $sql);
    
  $visible_fields = [
    "cd_pedido"   => "Código",
    "nm_pessoa"   => "Pessoa",
    "dt_pedido"     => "Data",
    "vl_pedido"    => "Valor ",
  ];
  
  $nr_fields = sizeof($visible_fields);

  $grid_pedido->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_pedido->SetColumnAlign("cd_pedido", "right");
  $grid_pedido->SetColumnAlign("dt_pedido", "center");
  $grid_pedido->SetColumnAlign("vl_pedido", "right");
  
  //Get_index_of
  $grid_pedido->SetCallback(get_index_of($visible_fields, "dt_pedido"), "Format_Date", ["sys", "pt_BR"]);

  //ExtraFields
  $grid_pedido->AddExtraFields([" "  => "Propriedades"]);

  //Propriedades
  $grid_pedido->SetLink($nr_fields, "man_pedido.php");
  $grid_pedido->SetLinkFields($nr_fields, ["f_cd_pedido" => "cd_pedido"]);
  
  //Filtros
  $grid_pedido->AddFilterField("cd_pedido", "Código", "number", "=",  "cd_pedido");
  $grid_pedido->AddFilterField("nm_pessoa", "Nome",   "text",   "~*", "nm_pessoa", false, false);
  $grid_pedido->AddFilterField("dt_pedido", "Data",   "number", "=",  "dt_pedido");
    
  //FilterProperties
  $grid_pedido->SetFilterProperties("nm_pedido", ["SetSize" => 30]);

  $html->AddObject($grid_pedido);
  
  $html->AddHtml("<br><a href=\"man_pedido.php\">Adicionar pedido</a>");

  echo $html->GetHtml();
  
  $conn->Close();
