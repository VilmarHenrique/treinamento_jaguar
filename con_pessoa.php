<?php
  session_start();
  require_once("lib/jaguar/jaguar.inc.php");
  require_once("include/funcoes.inc.php");
  
  $conn->SetDebug(0);
  
  //Html
  $title = "Extrato de Pessoa";
  $html = new JHtml($title);
  $html->AddHtml("<h3>$title</h3>");
  
  if (str_value($f_cd_pessoa))
  {
    //consulta
    $consulta = new JConsultation($conn);
    $consulta->SetWidth(750);
        
    ######### PESSOA ########
    
    $sql =
      "SELECT cd_pessoa, nm_pessoa, dt_nascimento
         FROM pessoa
        WHERE cd_pessoa = {$f_cd_pessoa}";
    
    $str = "<a href=\"man_pessoa.php?f_cd_pessoa=".$f_cd_pessoa.
           "&f_id_retorno=600\" class=\"consulta\"  name=\"pessoa\">Dados da Pessoa</a>";
    
    $consulta->AddArea("pessoa", $sql, $str);
    
    $visible_fields = array("cd_pessoa"     => "Código",
                            "nm_pessoa"     => "Nome",
                            "dt_nascimento" => "Dt. Nascimento");
    
    $consulta->SetVisibleFields("pessoa", $visible_fields);
    
    //Callback
    $consulta->SetCallBack("pessoa", get_index_of($visible_fields, "dt_nascimento"), "Format_Date", array("sys", "pt_BR"));

    ######### ENDEREÇO ########
      
    $sql =
       "SELECT u.ds_sigla, c.nm_cidade, e.nm_bairro, e.nm_logradouro, e.nr_endereco, e.id_tipo  
        FROM endereco e 
        JOIN cidade c ON c.cd_cidade = e.cd_cidade 
        JOIN uf u ON u.cd_uf = c.cd_uf
        WHERE cd_pessoa = {$f_cd_pessoa}
        ORDER BY e.id_tipo"; 
        
      
    $str = "<a href=\"man_endereco.php?f_cd_endereco=".$f_cd_endereco.
           "&f_id_retorno=600\" class=\"consulta\"  name=\"endereco\">Dados do Endereço</a>";
      
    $consulta->AddArea("endereco", $sql, $str);
      
    $visible_fields = array("ds_sigla"      => "UF",
                            "nm_cidade"     => "Cidade/UF",
                            "nm_bairro"     => "Bairro",
                            "nm_logradouro" => "Logradouro",
                            "nr_endereco"   => "Número",
                            "id_tipo"       => "Tipo",);
      
    $consulta->SetVisibleFields("endereco", $visible_fields);

    ######### TELEFONE ########
      
    $sql =
      "SELECT cd_pessoa, nr_telefone, id_principal, id_tipo  
       FROM telefone
       WHERE cd_pessoa = {$f_cd_pessoa}
       ORDER BY id_principal"; 
       
       
    $str = "<a href=\"man_telefone.php?f_cd_telefone=".$f_cd_telefone.
            "&f_id_retorno=600\" class=\"consulta\"  name=\"telefone\">Dados do Telefone</a>";
       
    $consulta->AddArea("telefone", $sql, $str);
       
    $visible_fields = array("nr_telefone"     => "Telefone",
                            "id_principal"    => "Principal",
                            "id_tipo"         => "Tipo",);
       
    $consulta->SetVisibleFields("telefone", $visible_fields);

    ######### E-MAIL ########
      
    $sql =
      "SELECT cd_pessoa, ds_email, id_principal, cd_email  
       FROM email
       WHERE cd_pessoa = {$f_cd_pessoa}
       ORDER BY id_principal"; 
         
         
    $str = "<a href=\"man_email.php?f_cd_email=".$f_cd_email.
              "&f_id_retorno=600\" class=\"consulta\"  name=\"email\">Dados de E-mail</a>";
         
    $consulta->AddArea("email", $sql, $str);
         
    $visible_fields = array("ds_email"     => "E-mail",
                            "id_principal" => "Principal",);
         
    $consulta->SetVisibleFields("email", $visible_fields);
 
  }
  else
    $html->AddHtml("<br><br><center><h3><b>Nenhuma Pessoa Selecionada!</b></h3></center>");

  $html->AddObject($consulta);
  
  echo $html->GetHtml();
  
  $conn->Close();