<?php
  session_start();
  $_SESSION = array();
  session_destroy();
  setcookie("_ua_","",time()-(60*60*24),"/");
  header("Location:http://localhost/bom/php/eshop");
  exit;
?>