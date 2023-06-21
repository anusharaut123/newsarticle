<?php
$conn=mysqli_connect("localhost","root","","newsarticle");
if(!$conn){
    die("connection failed ".mysqli_connect_error() );
}
?>