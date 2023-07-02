<?php
session_start();
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['signup'])){
        $email=$_POST['email'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        $validate=true;
        if($password!=$cpassword){
            $validate=false;
        }
        if($validate){
            $query= "INSERT INTO userdata (name, email, password) VALUES ('$username','$email', '$password')";
            $execute=mysqli_query($conn, $query);
            if($execute){
                header("Refresh:0");
            }else{
                echo "Not executed";
            }
        }

    }

   
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT id, name, email, password from userdata WHERE email='$email' AND password='$password' LIMIT 1";
        $execute=mysqli_query($conn, $query);
        $data=mysqli_fetch_array($execute);
        if($data['email']==$email && $data['password']==$password){
            $_SESSION['userid']=$data['id'];
            $_SESSION['username']=$data['name'];
            $_SESSION['useremail']=$data['email'];
            $_SESSION['usersessionid']=session_id();
            setcookie('userauth','true', time()+18000);
            header('location: userprofile.php');
            
        }
       
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login & Signup Form </title>
    <link rel="stylesheet" href="../style/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="#" class="login" method="POST">
            <div class="field">
              <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="login" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
          </form>
          <form action="#" class="signup" method="post">
            <div class="field">
              <input type="text" name="username" placeholder="Name" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="field">
              <input type="password" name="cpassword" placeholder="Confirm password" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="signup" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>

  <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>