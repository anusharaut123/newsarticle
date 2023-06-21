<?php
session_start();
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="true"){
  header('location: admin_login.php');
}

session_unset();
session_destroy();
setcookie ('auth',null,time()-90000,'/newsarticle',''); 
header('location: ../index.php');
?>