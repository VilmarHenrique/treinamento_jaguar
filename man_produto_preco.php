<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_pessoa = $f_cd_pessoa;
   include("md_produto.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Preço");
  $man->SetDBTable("pedido_preco");
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_produto" => $f_cd_produto);
  $man->SetLocation("insert", "man_produto.php", $key);
  $man->SetLocation("delete", "man_produto.php", $key);
  $man->SetLocation("update", "man_produto.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_produto))
  {
    $sql =
      "SELECT cd_produto, nm_produto
         FROM produto p
         WHERE cd_produto = {$f_cd_produto}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Produto</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_produto")} / {$rs->GetField("nm_produto")}</b>");
    }
    else
      conn_mostra_erro();
  }

    //cd_pedido_produto
    $cd_pedido_produto = new JFormHidden("f_cd_pedido_produto");
    $man->AddDBField("cd_pedido_produto", $cd_pedido_produto, false, true);

    //cd_pedido
    $cd_pedido = new JFormHidden("f_cd_pedido");
    $man->AddDBField("cd_pedido", $cd_pedido, false);

    //dt_pediddo
    $label = "Dt.Vigência";
    $dt_pediddo = new JFormDate("f_dt_pedido"); 
    $dt_pediddo->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("dt_pediddo", $dt_pediddo, "<b>{$label}</b>");

    //vl_produto
    $label = "Valor";
    $vl_produto = new JFormDate("f_vl_produto"); 
    $vl_produto->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("vl_produto", $vl_produto, "<b>{$label}</b>");

    //man End
    $man->BuildEndMaintenance();

    $man->AddHtml("<br>");

    //Sql
    $sql = [];
    $sql["fields"] = "p.dt_pedido, pp.vl_produto";
    $sql["from"]   = "pedido_produto pp 
                      JOIN pedido p ON pp.cd_pedido = p.cd_pedido";
    $sql["order"]  = "pp.cd_pedido_produto ";
    $sql["where"]  = "cd_produto = '{$f_cd_produto}' ";


    //Grid
    $grid_preco = new JDBGrid("pedido_preco_{$f_cd_pedido_preco}", $conn, $sql);

    $visible_fields = [
      "dt_pedido"       => "Dt. Vigência",
      "vl_produto"      => "Valor",
    ];
    
    $nr_fields = sizeof($visible_fields);
    
    $grid_preco->SetVisibleFields($visible_fields);
    

    //ColumnAlign
    $grid_preco->SetColumnAlign("dt_pedido",  "center");
    $grid_preco->SetColumnAlign("vl_produto",   "right");

    //Callback
    $grid_preco->SetCallback(get_index_of($visible_fields, "dt_pedido"), "Formate_Date");

    //Propriedades
    $grid_preco->AddExtraFields(array(" " => "Propriedades"));
    $grid_preco->SetLink($nr_fields, "man_produto.php");
    $grid_preco->SetLinkFields($nr_fields, ["f_cd_pedido_preco"  => "cd_pedido_preco",
                                            "f_cd_pedido_preco" => "cd_pedido_preco"]);

    $man->AddObject($grid_preco);
  
    $man->AddHtml("<br><a href=\"sel_produto.php\">Listagem de Produto</a>");
    
    echo $man->GetHtml();
    
    $conn->Close();
 