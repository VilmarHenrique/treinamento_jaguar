<?php
  $master= new JMasterDetail();
  $master->SetDefaultFile("man_produto.php");
  
  $key = array("f_cd_produto");
  $parameters[] = array("man_produto.php",     "Produto",  $key);
  $parameters[] = array("man_produto_preco.php", "Preço",  $key);
  
  $master->AddMasterDetail($parameters);