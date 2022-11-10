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
  $man->SetInsertKeys(true);
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_produto" => $f_pedido_produto);
  $man->SetLocation("insert", "man_pedido_produto.php", $key);
  $man->SetLocation("delete", "man_pedido_produto.php", $key);
  $man->SetLocation("update", "man_pedido_produto.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_pedido))
  {
    $sql =
      "SELECT cd_pedido, nm_pedido
         FROM pedido 
         WHERE cd_pedido = {$f_cd_pedido}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pedido</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pedido")}");
    }
    else
      conn_mostra_erro();
  }
    //Fields

    //cd_pedido_produto
    $cd_pedido_produto = new JFormHidden("f_cd_pedido_produto");
    $man->AddDBField("cd_pedido_produto", $cd_pedido_produto, false, true);

    //cd_produto
    $cd_produto = new JFormHidden("f_cd_produto");
    $man->AddDBField("cd_produto", $cd_produto,false);

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
    $man->AddDBField("qt_produto", $qt_produto, "<b>{$label},<b/>!");

    //vl_produto
    $label = "Vl. Unitário";
    $vl_produto = new JFormFormatedNumber("f_vl_produto");
    $vl_produto->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $man->AddDBField("vl_produto", $vl_produto, "<b>{$label},</b>");

    //vl_desconto
    $label = "Vl.Desconto";
    $vl_desconto = new JFormFormatedNumber("f_vl_desconto");
    $vl_desconto->SetTestIfEmpty(true, "Preencha o campo {$label}!"); 
    $man->AddDBField("vl_desconto", $vl_desconto, "<b>{$label},</b>");

    //vl_total
    $label = "Vl_Total";
    $vl_total = new JFormFormatedNumber("f_vl_total");
    $vl_total->SetTestIfEmpty(true, "Preencha o campo {}$label}!");
    $man->AddDBField("vl_total", $vl_total, "<b>{$lavel},</b>");

    //man End
    $man->BuildEndMaintenance();

    $man->AddHtml("<br>");

    //Sql
    $sql = [];
    $sql["fields"] = "p.nm_produto, pp.qt_produto, pp.vl_produto, pp.vl_desconto, pp.vl_total";
    $sql["from"]   = "pedido_produto pp
                      JOIN produto p ON p.cd_produto = pp.cd_produto";
    $sql["order"]  = "pp.cd_pedido_produto";
    $sql["where"]  = "cd_pedido = '{$f_cd_pedido}' ";

    //Grid
    $grid_pedido_produto = new JDBGrid("pedido_produto_{$f_cd_pedido_produto}", $conn, $sql);

    $visible_fields = [
      "dt_vigencia"   => "Dt. Vigência",
      "vl_preco"      => "Valor",  
      "nm_produto"    => "Produto",
      "vl_total"      => "Valor Total",
      "vl_desconto"   => "Desconto",
    ];
    
    $nr_fields = sizeof($visible_fields);
    
    $grid_produto_preco->SetVisibleFields($visible_fields);
    
    //ColumnAlign
    $grid_produto_preco->SetColumnAlign("dt_vigencia", "center");
    $grid_produto_preco->SetColumnAlign("vl_preco",   "right");

    //Callback
    $grid_produto_preco->SetCallback(get_index_of($visible_fields, "dt_vigencia"), "Format_Date",   ["sys", "pt_BR"]);
    $grid_produto_preco->SetCallback(get_index_of($visible_fields, "vl_preco"),    "Format_Number", [2, "sys", "pt_BR"]);
    
    //Propriedades
    $grid_produto_preco->AddExtraFields(array(" " => "Propriedades"));
    $grid_produto_preco->SetLink($nr_fields, "man_produto_preco.php");
    $grid_produto_preco->SetLinkFields($nr_fields, ["f_cd_produto"  => "cd_produto",
                                            "f_dt_vigencia" => "dt_vigencia_fmt"]);

    $man->AddObject($grid_produto_preco);
  
    $man->AddHtml("<br><a href=\"sel_produto.php\">Listagem de Produto</a>");
    
    echo $man->GetHtml();
    
    $conn->Close();
 