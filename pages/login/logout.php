<?php
  include('./config.php');
  require_once('login.php');
  
  session_unset();
  session_destroy();
  header('Location:' . $edulog_root .'pages/login');
 ?>
