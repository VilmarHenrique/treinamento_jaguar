<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  include("md_veiculo.php");
  
  //Html
  $man = new JMaintenance($conn, "Manutenção de Veículo");
  $man->SetDBTable("veiculo");
  $man->AddMasterDetail($master);

  //SetLocation
  $key = array("f_cd_veiculo" => $f_cd_veiculo);
  $man->SetLocation("insert", "man_veiculo_motorista.php", $key);
  $man->SetLocation("update", "man_veiculo_motorista.php", $key);
  $man->SetLocation("delete", "sel_veiculo.php");
  
  $conn->SetDebug(0);

  //cd_veiculo
  $cd_veiculo = new JFormHidden("f_cd_veiculo");
  $man->AddDBField("cd_veiculo", $cd_veiculo, false, true);

  //ds_veiculo
  $label = "Descrição";
  $ds_veiculo = new JFormText("f_ds_veiculo");
  $ds_veiculo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("ds_veiculo", $ds_veiculo, "<b>{$label}</b>");
  
  //cd_tipo_veiculo
  $label = "Tipo";
  $cd_tipo_veiculo = new JFormSelect("f_cd_tipo_veiculo");
  $cd_tipo_veiculo->SetTestIfEmpty(true, "Selecione o campo {$label}!");
  $cd_tipo_veiculo->SetFirstEmpty();
      
  $sql =
    "SELECT cd_tipo_veiculo AS value, ds_tipo_veiculo AS description
         FROM tipo_veiculo tv
        ORDER BY ds_tipo_veiculo";
    
    if ($rs = $conn->Select($sql))
    {
      $cd_tipo_veiculo->SetOptions($rs->GetArray(true));
    }
    else
      conn_mostra_erro();
  
  $man->AddDBField("cd_tipo_veiculo", $cd_tipo_veiculo, "<b>{$label}</b>");
  
  //ds_placa
  $label = "Placa";
  $ds_placa = new JFormPlaca("f_ds_placa");
  $ds_placa->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("ds_placa", $ds_placa, "<b>{$label}</b>");

  //nr_ano_fabricacao
  $label = "Fabricação";
  $nr_ano_fabricacao = new JFormNumber("f_nr_ano_fabricacao");
  $nr_ano_fabricacao->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nr_ano_fabricacao", $nr_ano_fabricacao, "<b>{$label}</b>");

  //nr_ano_modelo
  $label = "Modelo";
  $nr_ano_modelo = new JFormNumber("f_nr_ano_modelo");
  $nr_ano_modelo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $man->AddDBField("nr_ano_modelo", $nr_ano_modelo, "<b>{$label}</b>");

  //id_ativo
  $label = "Ativo";
  $id_ativo = new JFormSelect("f_id_ativo");
  $id_ativo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $id_ativo->SetOptions($op_id_sim_nao);
  $id_ativo->SetFirstEmpty();
  $man->AddDBField("id_ativo", $id_ativo, "<b>{$label}</b>");
    
  //man End
  $man->BuildEndMaintenance();
  
  $man->AddHtml("<br><a href=\"sel_veiculo.php\">Listagem de Veículos</a>");
  
  echo $man->GetHtml();
  
  $conn->Close();