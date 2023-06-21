<?php
session_start();
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: admin_login.php');
}

session_unset();
session_destroy();
setcookie ('auth',null,time()-90000,'/newsarticle',''); 
header('location: ../index.php');
?>