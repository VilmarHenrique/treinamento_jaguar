<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Vendas Gerais";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
 
  $conn->SetDebug(0);

  //Form
  $form = new JForm();

  $label = "Arquivo";
  $form->OpenRow();
  $form->OpenHeader("Arquivo");
  $form->OpenCell();
  $ds_arquivo = new JFormFile("f_ds_arquivo");
  $ds_arquivo->SetTestIfEmpty(true, "Preencha o campo {$label}!");
  $form->AddObject($ds_arquivo);

  $form->OpenRow();
  $form->OpenHeader("", ["colspan" => 2]);
  $submit = new JFormSubmit("f_submit", "Enviar");
  $form->AddObject($submit);

  if ($form->IsSubmitted())
  {
    $arr_arquivo = file($_FILES["f_ds_arquivo"]["tmp_name"]);
   
      $tbl = new JTable();

      $tbl->OpenRow();
      $tbl->OpenHeader("NF");
      $tbl->OpenHeader("Cliente");
      $tbl->OpenHeader("CNPJ");
      $tbl->OpenHeader("Produto");
      $tbl->OpenHeader("Valor");
      $tbl->OpenHeader("Qtd");
    
      $qtdt = 0;
      $vlt  = 0;

      foreach ($arr_arquivo as $ds_linha)
      {                      
        
          $arr_linha = explode(";", $ds_linha);

          $nr_nota_fiscal = $arr_linha[0];
          $cd_pessoa      = $arr_linha[1];
          $nm_pessoa      = $arr_linha[2];
          $nr_cnpj        = $arr_linha[3];
          $cd_produto     = $arr_linha[7]; 
          $nm_produto     = $arr_linha[8];
          $vl_financeiro  = Format_Number($arr_linha[9] , 2, "pt_BR", "sys");
          $qt_unid_cx     = Format_Number($arr_linha[10], 2, "pt_BR", "sys");
          $vl_volume_cx   = Format_Number($arr_linha[11], 2, "pt_BR", "sys");
          $soma           = $qt_unid_cx * $vl_volume_cx;
          $valorTotal     = $vlt += $vl_financeiro;
          $QtdTotal       = $qtdt += $qt_unid_cx;

          if (!is_numeric($nr_nota_fiscal)){
          
            continue;
          }
                             
          $tbl->OpenRow();
          $tbl->OpenCell($nr_nota_fiscal);     
          $tbl->OpenCell($nm_pessoa);       
          $tbl->OpenCell($nr_cnpj);        
          $tbl->OpenCell($nm_produto);       
          $tbl->OpenCell(Format_Number($vl_financeiro, 2, "sys", "pt_BR"), ["align" => "right"]);
          $tbl->OpenCell(Format_Number($soma, 0, "sys", "pt_BR"), ["align" => "right"]);                              
      }

      $tbl->OpenRow(); 
      $tbl->OpenCell("<b>TOTAL</b>", ["colspan" => 4]);
      $tbl->OpenCell(Format_Number($valorTotal, 2, "sys", "pt_BR"), ["align" => "right"]);
      $tbl->OpenCell(Format_Number($QtdTotal, 0, "sys", "pt_BR"), ["align" => "right"]);
    } 
  
       
  $html->AddObject($form);

  $html->AddObject($tbl);

  echo $html->GetHtml();

  $conn->Close();