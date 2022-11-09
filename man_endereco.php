<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_pessoa = $f_cd_pessoa;
   include("md_pessoa.php");
   
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Endereço");
  $man->SetDBTable("endereco");
  $man->AddMasterDetail($master);
  
  //SetLocation
  $key = array("f_cd_pessoa" => $f_cd_pessoa);
  $man->SetLocation("insert", "man_endereco.php", $key);
  $man->SetLocation("delete", "man_endereco.php", $key);
  $man->SetLocation("update", "man_endereco.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_pessoa))
  {
    $sql =
      "SELECT cd_pessoa, nm_pessoa
         FROM pessoa t
         WHERE cd_pessoa = {$f_cd_pessoa}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("<b>Pessoa</b>");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_pessoa")} / {$rs->GetField("nm_pessoa")}</b>");
    }
    else
      conn_mostra_erro();
  }
    //cd_telefone
    $cd_endereco = new JFormHidden("f_cd_endereco");
    $man->AddDBField("cd_endereco", $cd_endereco, false, true);

    //cd_pessoa
    $cd_pessoa = new JFormHidden("f_cd_pessoa");
    $man->AddDBField("cd_pessoa", $cd_pessoa, false);

    //id_tipo
    $label = "Tipo";
    $id_tipo = new JFormSelect("f_id_tipo");
    $id_tipo->SetOptions($op_id_tipo_endereco);
    $id_tipo->SetFirstEmpty();
    $id_tipo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $man->AddDBField("id_tipo", $id_tipo, "<b>{$label}</b>");

    //cd_cidade/ds_sigla
    $label = "Cidade / UF";
    $cd_cidade = new JFormSelect("f_cd_cidade");
    $cd_cidade->SetFirstEmpty();
    $cd_cidade->SetTestIfEmpty(true, "Preencha o campo {$label}!");

    $sql =
        "SELECT c.cd_cidade AS value, c.nm_cidade ||' / '|| u.ds_sigla AS description
          FROM cidade c  
          JOIN uf u ON c.cd_uf = u.cd_uf  
        ORDER BY cd_cidade";
  
  if ($rs = $conn->Select($sql))
  {
    $cd_cidade->SetOptions($rs->GetArray(true));
  }
  else
    conn_mostra_erro();

    $man->AddDBField("cd_cidade", $cd_cidade, "<b>{$label}</b>");
   
    //nm_bairro
    $label = "Bairro";
    $nm_bairro = new JFormText("f_nm_bairro"); 
    $nm_bairro->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("nm_bairro", $nm_bairro, "<b>{$label}</b>");
   
    //nm_logradouro
    $label = "Logradouro";
    $nm_logradouro = new JFormText("f_nm_logradouro"); 
    $nm_logradouro->SetTestIfEmpty(true,"Preencha o campo {$label}!");
    $man->AddDBField("nm_logradouro", $nm_logradouro, "<b>{$label}</b>");

    //nr_endereco
    $label = "Número";
    $nr_endereco = new JFormText("f_nr_endereco");
    $nr_endereco->SetTestIfEmpty(true, "Preencha o campo {$label}!");
    $man->AddDBField("nr_endereco", $nr_endereco, "<b>{$label}</b>");

    //ds_complemento
    $label = "Complemento";
    $ds_complemento = new JFormText("f_ds_complemento");
    $man->AddDBField("ds_complemento", $ds_complemento, "<b>{$label}</b>");
    
    //man End
    $man->BuildEndMaintenance();

    $man->AddHtml("<br>");

    //Sql
    $sql = [];
    $sql["fields"] = "u.ds_sigla, c.nm_cidade, e.nm_bairro, e.nm_logradouro, e.nr_endereco, e.id_tipo";
    $sql["from"]   = "endereco e
                      JOIN cidade c ON c.cd_cidade = e.cd_cidade
                      JOIN uf u ON u.cd_uf = c.cd_uf";
    $sql["order"]  = "e.id_tipo";
    $sql["where"]  = "cd_pessoa = '{$f_cd_pessoa}' ";

    //Grid
    $grid_endereco = new JDBGrid("endereco_{$f_cd_pessoa}", $conn, $sql);

    $visible_fields = [
      "ds_sigla"       => "UF",
      "nm_cidade"      => "Cidade/UF",
      "nm_bairro"      => "Bairro",
      "nm_logradouro"  => "Logradouro",
      "nr_endereco"    => "Número",
      "id_tipo"        => "Tipo",      
    ];
    
    $nr_fields = sizeof($visible_fields);
    
    $grid_endereco->SetVisibleFields($visible_fields);
    

    //ColumnAlign
    $grid_endereco->SetColumnAlign("ds_sigla",  "center");
    $grid_endereco->SetColumnAlign("id_tipo",   "center");


    //Callback
    $grid_endereco->SetCallback(get_index_of($visible_fields, "id_tipo"), "formata_id_tipo_endereco");

    //Propriedades
    $grid_endereco->AddExtraFields(array(" " => "Propriedades"));
    $grid_endereco->SetLink($nr_fields, "man_endereco.php");
    $grid_endereco->SetLinkFields($nr_fields, ["f_cd_endereco"  => "cd_endereco",
                                            "f_cd_pessoa" => "cd_pessoa"]);

    //Filtros
    

    $man->AddObject($grid_endereco);
  
    $man->AddHtml("<br><a href=\"sel_pessoa.php\">Listagem de Pessoas</a>");
    
    echo $man->GetHtml();
    
    $conn->Close();
 