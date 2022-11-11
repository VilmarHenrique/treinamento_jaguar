<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_produto = $f_cd_produto;
   include("md_produto.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Preço");
  $man->SetDBTable("produto_preco");
  $man->SetInsertKeys(true);
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_produto" => $f_cd_produto);
  $man->SetLocation("insert", "man_produto_preco.php", $key);
  $man->SetLocation("delete", "man_produto_preco.php", $key);
  $man->SetLocation("update", "man_produto_preco.php", $key);
  
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
    //Fields

    //cd_produto
    $cd_produto = new JFormHidden("f_cd_produto");
    $man->AddDBField("cd_produto", $cd_produto, false, true);

    //dt_vigencia
    $label = "Dt.Vigência";
    $dt_vigencia = new JFormDate("f_dt_vigencia"); 
    $dt_vigencia->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("dt_vigencia", $dt_vigencia, "<b>{$label}</b>",true);

    //vl_preco
    $label = "Valor";
    $vl_preco = new JFormFormatedNumber("f_vl_preco"); 
    $vl_preco->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("vl_preco", $vl_preco, "<b>{$label}</b>");

    //man End
    $man->BuildEndMaintenance();

    $man->AddHtml("<br>");

    //Sql
    $sql = [];
    $sql["fields"] = "cd_produto, dt_vigencia,
                      TO_CHAR(dt_vigencia, 'DD/MM/YYYY') AS dt_vigencia_fmt,
                      vl_preco";
    $sql["from"]   = "produto_preco pp ";
    $sql["order"]  = "cd_produto";
    $sql["where"]  = "cd_produto = '{$f_cd_produto}' ";

    //Grid
    $grid_produto_preco = new JDBGrid("produto_{$f_cd_produto}", $conn, $sql);

    $visible_fields = [
      "dt_vigencia"   => "Dt. Vigência",
      "vl_preco"      => "Valor",
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
 