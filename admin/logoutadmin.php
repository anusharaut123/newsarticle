<?php
session_start();
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}

session_unset();
session_destroy();
setcookie ('auth',null,time()-90000,'/newsarticle',''); 
header('location:admin_login.php');
?>