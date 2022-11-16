<?php
  $master= new JMasterDetail();
  $master->SetDefaultFile("man_veiculo.php");
  
  $key = array("f_cd_veiculo");
  $parameters[] = array("man_veiculo.php",           "Veículos",  $key);
  $parameters[] = array("man_veiculo_motorista.php", "Motorista", $key);
  
  $master->AddMasterDetail($parameters);

 ?> 