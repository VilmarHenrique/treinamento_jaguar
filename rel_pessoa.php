<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  //require_once("lib/fpdf/pdf.php");
  require_once("include/funcoes.inc.php");
  
  $titulo = "Relatório de Pessoa";
  
  //rel_valida_permissao($titulo);
  
  $conn->SetDebug(0);

  $cd_cidade = implode(",", $_REQUEST["f_cd_cidade_destination"]);  
  
  $sql = 
    "SELECT p.cd_pessoa ,p.nm_pessoa, e.nm_logradouro,
            e.nm_bairro, c.nm_cidade, em.ds_email, t.nr_telefone
       FROM pessoa p 
       LEFT JOIN endereco e ON   e.cd_pessoa = p.cd_pessoa
                           AND e.cd_endereco = (SELECT e2.cd_endereco  
                                                  FROM endereco e2
                                                 WHERE e2.cd_pessoa = p.cd_pessoa
                                                 ORDER BY e2.id_tipo  DESC
                                                 LIMIT 1)
       LEFT JOIN cidade   c ON   e.cd_cidade = c.cd_cidade
       LEFT JOIN telefone t ON   p.cd_pessoa = t.cd_pessoa 
                           AND t.cd_telefone = (SELECT t2.cd_telefone 
                                                  FROM telefone t2 
                                                 WHERE t2.cd_pessoa = p.cd_pessoa 
                                                 ORDER BY t2.id_principal  DESC
                                                 LIMIT 1)
       LEFT JOIN email   em ON em.cd_pessoa = p.cd_pessoa
                            AND em.cd_email = (SELECT em2.cd_email 
                                                 FROM email em2
                                                WHERE em2.cd_pessoa = p.cd_pessoa
                                                ORDER BY em2.id_principal  DESC
                                                LIMIT 1)
      WHERE TRUE " . 
      restricao_where("AND", "c.cd_cidade", "IN", $cd_cidade, "", true);
  
  switch ($f_id_formato)
  {
    case "1": //PDF
      require_once("include/gera_relatorio_pdf.inc.php");
      
      //sub_titulo
      $sub_titulo2 = "";
      $sub_titulo2 .= formata_sub_titulo_texto(obtem_dado_tabela($f_cd_cargo,         "cargo",                      "nm_cargo",  "cd_cargo"),  "Cargo",  40);
      $sub_titulo2 .= formata_sub_titulo_texto(obtem_dado_tabela($f_cd_pessoa_filial, "vw_empresa_contabil_filial", "nm_pessoa", "cd_pessoa"), "Filial", 40);
      $sub_titulo2 .= formata_sub_titulo_op("formata_id_mes", $f_dt_mes, "Mês");
      $sub_titulo2 .= formata_sub_titulo_data($f_dt_nascimento_inicial, $f_dt_nascimento_final, "Dt. Aniversário");
      
      //Relatório
      $relatorio = new gera_relatorio_pdf($conn, "v", $titulo, false, $sub_titulo2);
      
      //Campos
      unset($arr_campo);
      $arr_campo[] = array("width" => 60, "fieldName" => "cd_funcionario|nm_funcionario", "label" => "Funcionário", "align" => "L");
      $arr_campo[] = array("width" => 50, "fieldName" => "nm_pessoa_filial",              "label" => "Filial",      "align" => "L");
      $arr_campo[] = array("width" => 20, "fieldName" => "dt_nascimento",                 "label" => "Nascimento",  "align" => "C");
      $arr_campo[] = array("width" => 70, "fieldName" => "nm_cargo",                      "label" => "Cargo",       "align" => "L");
      
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