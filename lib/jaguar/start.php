<?php
  session_start();
  setcookie("logado", true, time()+3600, '/');
  echo "OK";
?>