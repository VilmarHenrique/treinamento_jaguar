<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("lib/fpdf/pdf.php");
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

      //Relatório
      $relatorio = new gera_relatorio_pdf($conn, "v", $titulo);
    
      //Campos
      unset($arr_campo);
      $arr_campo[] = array("width" => 15, "fieldName" => "cd_pessoa",     "label" => "Código",     "align" => "R");
      $arr_campo[] = array("width" => 40, "fieldName" => "nm_pessoa",     "label" => "Nome",       "align" => "L");
      $arr_campo[] = array("width" => 40, "fieldName" => "nm_logradouro", "label" => "Logradouro", "align" => "L");
      $arr_campo[] = array("width" => 30, "fieldName" => "nm_bairro",     "label" => "Bairro",     "align" => "L");
      $arr_campo[] = array("width" => 40, "fieldName" => "nm_cidade",     "label" => "Cidade",     "align" => "L");
      $arr_campo[] = array("width" => 20, "fieldName" => "ds_email",      "label" => "E-mail",     "align" => "L");
      $arr_campo[] = array("width" => 15, "fieldName" => "nr_telefone",   "label" => "Telefone",   "align" => "L");
      
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