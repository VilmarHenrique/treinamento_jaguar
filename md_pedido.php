<?php
  $master = new JMasterDetail();
  $master->SetDefaultFile("man_pedido.php");
  
  $key = array("f_cd_pedido");
  $parameters[] = array("man_pedido.php",         "Pedido",  $key);
  $parameters[] = array("man_pedido_produto.php", "Produto",  $key);
    
  $master->AddMasterDetail($parameters);