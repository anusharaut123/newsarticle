<?php
session_start();
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: admin_login.php');
}

session_unset();
session_destroy();
setcookie ('userauth',null,time()-90000); 
header('location: ../index.php');
?>