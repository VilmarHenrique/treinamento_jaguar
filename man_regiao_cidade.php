<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $s_md_cd_regiao = $f_cd_regiao;
  include("md_regiao.php");
  
  function obtem_valores()
  {
    global $conn, $man, $cd_cidade;
    
    if (strlen($cd_cidade->GetValue()))
    {
      $sql = <<<SQL
        SELECT cd_cidade,
               c.nm_cidade ||' / '|| u.ds_sigla AS nm_cidade
          FROM cidade
          JOIN uf u ON u.cd_uf = c.cd_uf
         WHERE cd_cidade = '{$cd_cidade->GetValue()}'
SQL;
      
      if ($rs = $conn->Select($sql))
        $cd_cidade->AddOption($rs->GetField("cd_cidade"), $rs->GetField("nm_cidade"));
      else
        conn_mostra_erro();
    }
  }
  
  $conn->SetDebug(0);
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Cidades da Região");
  $man->AddMasterDetail($master);
  $man->SetDBTable("cidade_regiao");
  $man->SetInsertKeys(true);
  $man->SetShowUpdate(false);
  
  //ConnectSignal
  $man->ConnectSignal("after_load_db_values", "obtem_valores");
  
  //SetLocation
  $key = array("f_cd_regiao" => $f_cd_regiao);
  $man->SetLocation("insert", "man_regiao_cidade.php", $key);
  $man->SetLocation("delete", "man_regiao_cidade.php", $key);
  $man->SetLocation("update", "man_regiao_cidade.php", $key);
  
  //Cabeçalho
  if (strlen($f_cd_regiao))
  {
    $sql =
      "SELECT cd_regiao, nm_regiao
         FROM regiao
        WHERE cd_regiao = {$f_cd_regiao}";
    
    if ($rs = $conn->Select($sql))
    {
      $man->mForm->OpenRow();
      $man->mForm->OpenHeader("Região");
      $man->mForm->OpenCell("<b>{$rs->GetField("cd_regiao")} / {$rs->GetField("nm_regiao")}</b>");
    }
    else
      conn_mostra_erro();
  }
  
  //cd_regiao
  $cd_regiao = new JFormHidden("f_cd_regiao");
  $man->AddDBField("cd_regiao", $cd_regiao, false, true);
  
  //cd_cidade
  $label = "Cidade";
  $cd_cidade = new JFormSelect("f_cd_cidade");
  $cd_cidade->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $cd_cidade->SetFirstEmpty();
  
  $sql = <<<SQL
    SELECT c.cd_cidade AS value,
           c.nm_cidade ||' / '|| u.ds_sigla AS description
      FROM cidade c
      JOIN uf u ON u.cd_uf = c.cd_uf
     ORDER BY c.nm_cidade
SQL;
  
  if ($rs = $conn->Select($sql))
    $cd_cidade->SetOptions($rs->GetArray(true));
  else
    conn_mostra_erro();
  
  $man->AddDBField("cd_cidade", $cd_cidade, "<b>{$label}</b>", true);
  
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br>");
  
  //Sql
  $sql = [];
  $sql["fields"] = "cr.cd_cidade, cr.cd_regiao, c.nm_cidade, u.ds_sigla, p.nm_pais";
  $sql["count"]  = "cr.cd_cidade";
  $sql["from"]   = "cidade_regiao cr
                    JOIN cidade c ON c.cd_cidade = cr.cd_cidade
                    JOIN uf     u ON     u.cd_uf = c.cd_uf
                    JOIN pais   p ON   p.cd_pais = u.cd_pais ";
  $sql["order"]  = "c.nm_cidade";
  $sql["where"]  = "cr.cd_regiao = '{$f_cd_regiao}' ";
  
  //Grid
  $grid_regiao_cidade = new JDBGrid("regiao_cidade_{$f_cd_regiao}", $conn, $sql);
  
  $visible_fields = [
    "nm_pais"   => "País",
    "ds_sigla"  => "Estado",
    "nm_cidade" => "Cidade"
  ];
  
  $nr_fields = sizeof($visible_fields);
  
  $grid_regiao_cidade->SetVisibleFields($visible_fields);
  
  //ColumnAlign
  $grid_regiao_cidade->SetColumnAlign("ds_sigla", "center");
  
  //Propriedades
  $grid_regiao_cidade->AddExtraFields(array(" " => "Propriedades"));
  $grid_regiao_cidade->SetLink($nr_fields, "man_regiao_cidade.php");
  $grid_regiao_cidade->SetLinkFields($nr_fields, ["f_cd_cidade" => "cd_cidade",
                                                  "f_cd_regiao" => "cd_regiao"]);
  
  //Filtros
  $grid_regiao_cidade->AddFilterField("nm_cidade", "Cidade", "text", "~*");
  $grid_regiao_cidade->AddFilterField("ds_sigla",  "Estado", "text", "~*", false, false, false);
  $grid_regiao_cidade->AddFilterField("nm_pais",   "País",   "text", "~*", false, false, true, ["colspan" => 3]);
  
  //SetFilterProperties
  $grid_regiao_cidade->SetFilterProperties("ds_sigla", ["size" => 2]);
  
  $man->AddObject($grid_regiao_cidade);
  
  $man->AddHtml("<br><a href=\"sel_regiao.php\">Listagem de Regiões</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();