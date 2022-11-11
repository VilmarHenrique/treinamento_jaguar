<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_pedido = $f_cd_pedido;
   include("md_pedido.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Pedido");
  $man->SetDBTable("pedido_produto");
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_pedido" => $f_cd_pedido);
  $man->SetLocation("insert", "man_pedido_produto.php", $key);
  $man->SetLocation("delete", "man_pedido_produto.php", $key);
  $man->SetLocation("update", "man_pedido_produto.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_pedido))
  {
    $sql =
      "SELECT p2.cd_pedido, p.nm_pessoa 
         FROM pedido p2
         JOIN pessoa p ON p.cd_pessoa = p2.cd_pessoa
         WHERE cd_pedido = {$f_cd_pedido}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pedido</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pedido")}");
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pessoa</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pedido")} / {$rs->GetField("nm_pessoa")}</b>");    
    }
    else
      conn_mostra_erro();
  }
    //Fields

    //cd_pedido
    $cd_pedido = new JFormHidden("f_cd_pedido");
    $man->AddDBField("cd_pedido", $cd_pedido, false);

    //cd_pedido_produto
    $cd_pedido_produto = new JFormHidden("f_cd_pedido_produto");
    $man->AddDBField("cd_pedido_produto", $cd_pedido_produto, false, true);

    //cd_produto
    $label = "Produto";
    $cd_produto = new JFormSelect("f_cd_produto");
    $cd_produto->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $cd_produto->SetFirstEmpty();
      
    $sql = <<<SQL
      SELECT p.cd_produto AS value,
             p.cd_produto ||' / '|| p.nm_produto AS description
        FROM produto p
        ORDER BY p.cd_produto
  SQL;
    
    if ($rs = $conn->Select($sql))
      $cd_produto->SetOptions($rs->GetArray(true));
    else
      conn_mostra_erro();
    
    $man->AddDBField("cd_produto", $cd_produto, "<b>{$label}</b>");

    //qt_produto
    $label = "Quantidade";
    $qt_produto = new JFormNumber("f_qt_produto");
    $qt_produto->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $man->AddDBField("qt_produto", $qt_produto, "<b>{$label}<b/>");

    //vl_produto
    $label = "Vl.Unitário";
    $vl_produto = new JFormFormatedNumber("f_vl_produto");
    $vl_produto->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $man->AddDBField("vl_produto", $vl_produto, "<b>{$label}</b>");

    //vl_desconto
    $label = "Vl.Desconto";
    $vl_desconto = new JFormFormatedNumber("f_vl_desconto");
    $vl_desconto->SetTestIfEmpty(true, "Preencha o campo {$label}!"); 
    $man->AddDBField("vl_desconto", $vl_desconto, "<b>{$label}</b>");

    //vl_total
    $label = "Vl.Total";
    $vl_total = new JFormFormatedNumber("f_vl_total");
    $vl_total->SetTestIfEmpty(true, "Preencha o campo {}$label}!");
    $man->AddDBField("vl_total", $vl_total, "<b>{$label}</b>");

    //man End
    $man->BuildEndMaintenance();

    $man->AddHtml("<br>");

    //Sql
    $sql = [];
    $sql["fields"] = "pp.cd_pedido, pp.cd_pedido_produto, p.nm_produto, pp.qt_produto, pp.vl_produto, pp.vl_desconto, pp.vl_total";
    $sql["from"]   = "pedido_produto pp
                      JOIN produto p ON p.cd_produto = pp.cd_produto";
    $sql["order"]  = "pp.cd_pedido_produto";
    $sql["where"]  = "cd_pedido = '{$f_cd_pedido}' ";

    //Grid
    $grid_pedido_produto = new JDBGrid("pedido_produto_{$f_cd_pedido_produto}", $conn, $sql);

    $visible_fields = [
      "nm_produto"    => "Produto",
      "qt_produto"    => "Quantidade",
      "vl_produto"    => "Vl. Unitário",
      "vl_desconto"   => "Desconto",
      "vl_total"      => "Vl. Total",        
    ];
    
    $nr_fields = sizeof($visible_fields);
    
    $grid_pedido_produto->SetVisibleFields($visible_fields);
    
    //ColumnAlign
    $grid_pedido_produto->SetColumnAlign("vl_produto",  "right");
    $grid_pedido_produto->SetColumnAlign("vl_total",    "right");
    $grid_pedido_produto->SetColumnAlign("vl_desconto", "right");

    //Callback
    $grid_pedido_produto->SetCallback(get_index_of($visible_fields, "vl_total"),    "Format_Number", [2, "sys", "pt_BR"]);
    $grid_pedido_produto->SetCallback(get_index_of($visible_fields, "vl_desconto"),    "Format_Number", [2, "sys", "pt_BR"]);
    $grid_pedido_produto->SetCallback(get_index_of($visible_fields, "vl_produto"),    "Format_Number", [2, "sys", "pt_BR"]);
    
    //Propriedades
    $grid_pedido_produto->AddExtraFields(array(" " => "Propriedades"));
    $grid_pedido_produto->SetLink($nr_fields, "man_pedido_produto.php");
    $grid_pedido_produto->SetLinkFields($nr_fields, ["f_cd_pedido_produto" => "cd_pedido_produto",
                                                     "f_cd_pedido"         =>"cd_pedido"]);

    $man->AddObject($grid_pedido_produto);
  
    $man->AddHtml("<br><a href=\"sel_pedido.php\">Listagem de Pedido</a>");
    
    echo $man->GetHtml();
    
    $conn->Close();
 