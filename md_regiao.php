<?php
  $master= new JMasterDetail();
  $master->SetDefaultFile("man_regiao.php");
  
  $key = array("f_cd_regiao");
  $parameters[] = array("man_regiao.php",        "Região",  $key);
  $parameters[] = array("man_regiao_cidade.php", "Cidades", $key);
  
  $master->AddMasterDetail($parameters);