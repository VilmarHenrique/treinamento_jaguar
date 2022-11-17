<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("lib/fpdf/pdf.php");
  require_once("include/funcoes.inc.php");
  
  $titulo = "Relatório de Veículos";
  
  //rel_valida_permissao($titulo);
  
  $conn->SetDebug(0);

  $cd_tipo_veiculo = implode(",", $_REQUEST["f_cd_tipo_veiculo_destination"]);  
  
  $sql = 
    "SELECT v.cd_veiculo, v.ds_veiculo, tv.ds_tipo_veiculo,
            v.ds_placa, v.nr_ano_fabricacao, v.nr_ano_modelo, p.nm_pessoa  
       FROM veiculo v
       JOIN tipo_veiculo tv         ON tv.cd_tipo_veiculo = v.cd_tipo_veiculo
       JOIN veiculo_motorista vm    ON       v.cd_veiculo = vm.cd_veiculo
                                   AND     vm.dt_vigencia = (SELECT vm2.dt_vigencia
                                                               FROM veiculo_motorista vm2 
                                                              WHERE vm2.dt_vigencia <= current_date
                                                                AND vm2.cd_veiculo   = v.cd_veiculo 
                                                              ORDER BY vm2.dt_vigencia DESC
                                                              LIMIT 1)
       JOIN pessoa p                ON        p.cd_pessoa = vm.cd_pessoa
      WHERE TRUE " .
       restricao_where("AND", "tv.cd_tipo_veiculo", "IN", $cd_tipo_veiculo, "", true);                             
  
  switch ($f_id_formato)
  {
    case "1": //PDF
      require_once("include/gera_relatorio_pdf.inc.php");

      //Relatório
      $relatorio = new gera_relatorio_pdf($conn, "v", $titulo);
    
      //Campos
      unset($arr_campo);
      $arr_campo[] = array("width" => 10, "fieldName" => "cd_veiculo",        "label" => "Código",    "align" => "R");
      $arr_campo[] = array("width" => 50, "fieldName" => "ds_veiculo",        "label" => "Descrição", "align" => "L");
      $arr_campo[] = array("width" => 40, "fieldName" => "ds_tipo_veiculo",   "label" => "Tipo",      "align" => "C");
      $arr_campo[] = array("width" => 20, "fieldName" => "ds_placa",          "label" => "Placa",     "align" => "C",
                           "callback" => ["Format_Placa", ["sys", "pt_BR"]]);
      $arr_campo[] = array("width" => 15, "fieldName" => "nr_ano_fabricacao", "label" => "Fab.",      "align" => "C");
      $arr_campo[] = array("width" => 15, "fieldName" => "nr_ano_modelo",     "label" => "Modelo",    "align" => "C");
      $arr_campo[] = array("width" => 50, "fieldName" => "nm_pessoa",         "label" => "Motorista", "align" => "L");

      $relatorio->monta_campos($arr_campo);
      
      $relatorio->gera_relatorio_sql($sql);
      
      $relatorio->Output(REL_ARQ_NOME, "I");
    break;
  
    case "2": //XLS
      require_once("lib/writeexcel/db_write_excel.php");
      gera_relatorio_xls($sql);  
    break;
  }
  
  $conn->Close();