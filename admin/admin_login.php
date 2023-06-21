<?php
session_start();
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT email, password from admin_login WHERE email='$email' AND password='$password' LIMIT 1";
        $execute=mysqli_query($conn, $query);
        $data=mysqli_fetch_array($execute);
        if($data['email']==$email && $data['password']==$password){
            $_SESSION['email']=$data['email'];
            $_SESSION['adminsessionid']=session_id();
            setcookie('auth','admintrue', time()+18000);
            header('location: adminhome.php');
            
        }
       
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--costom css-->

<link rel="stylesheet" href=style/admin.css>
</head>
<body>
    <div class="container">
        <form action="#" method="post">
            <h3>Admin Login</h3>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" id="pwd">
  </div>

  <input type="submit" name="login" class="btn btn-primary" value="login">
</form>

    </div>
</body>
</html>

