<?php
  $master= new JMasterDetail();
  $master->SetDefaultFile("man_pessoa.php");
  
  $key = array("f_cd_pessoa");
  $parameters[] = array("man_pessoa.php",   "Pessoa",    $key);
  $parameters[] = array("man_email.php",    "E-mail",    $key);
  $parameters[] = array("man_telefone.php", "Telefone",  $key);
  $parameters[] = array("man_endereco.php", "Endereço",  $key);
  
  $master->AddMasterDetail($parameters);