<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");

  //Html
  $title = "Importação de Pessoas";
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

    foreach ($arr_arquivo as $ds_linha)
    {
      $arr_linha     = explode(",", $ds_linha);
      $nm_pessoa     = $arr_linha[0];
      $dt_nascimento = Format_Date($arr_linha[1], "pt_BR", "sys");
      $ds_email      = $arr_linha[2];
      $nr_telefone   = trim($arr_linha[3]);
      $tam_telefone  = strlen($nr_telefone);
        if ($tam_telefone > 10 )
      {
       $id_tipo = 3;
      }
      else {
       $id_tipo = 2;
      };    


      $cd_pessoa = busca_nextval("pessoa_cd_pessoa_seq");
          
      //Insert "pessoa"
      $values = [
        "cd_pessoa"     => $cd_pessoa,
        "nm_pessoa"     => $nm_pessoa,
        "dt_nascimento" => $dt_nascimento,                
      ];

      if ($conn->Insert("pessoa", $values))
      {
        //Insert "telefone;
        $values = [
          "cd_pessoa"    => $cd_pessoa,
          "nr_telefone"  => $nr_telefone,
          "id_tipo"      => $id_tipo,
          "id_principal" => 1,
        ];

        if ($conn->Insert("telefone", $values))
        {
          //Insert "email";
          $values = [
            "cd_pessoa"    => $cd_pessoa,
            "ds_email"     => $ds_email,
            "id_principal" => 1,
          ];

          if (!$conn->Insert("email",$values))
            conn_mostra_erro();
        }
        else
          conn_mostra_erro();
      }
      else
          conn_mostra_erro();
    }
   
  }   
   
  $html->AddObject($form);

  echo $html->GetHtml();

  $conn->Close();