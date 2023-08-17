<?php
session_start();
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['signup'])){
        $email=$_POST['email'];
        $username=$_POST['username'];
        $age=$_POST['age'];
        $address=$_POST['address'];
        $gender=$_POST['gender'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        $validate=true;
        if($password!=$cpassword){
            $validate=false;
        }
        if($validate){
            $query= "INSERT INTO userdata (name, email, age, address, gender, password) VALUES ('$username','$email', '$age', '$address', '$gender', '$password')";
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
        $query="SELECT id, name, email, age, address, gender, password from userdata WHERE email='$email' AND password='$password' LIMIT 1";
        $execute=mysqli_query($conn, $query);
        $data=mysqli_fetch_array($execute);
        if($data['email']==$email && $data['password']==$password){
            $_SESSION['userid']=$data['id'];
            $_SESSION['username']=$data['name'];
            $_SESSION['useremail']=$data['email'];
            $_SESSION['userage']=$data['age'];
            $_SESSION['useraddress']=$data['address'];
            $_SESSION['usergender']=$data['gender'];
            $_SESSION['usersessionid']=session_id();
            setcookie('userauth','true', time()+18000);
            header('location: myprofile.php');
            
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
          <form action="#" class="signup" method="post" onsubmit="return validateForm()">
  <div class="field">
    <input type="text" name="username" id="username" placeholder="Name" required>
  </div>
  <div class="field">
    <input type="text" name="email" id="email" placeholder="Email" required>
  </div>
  <div class="field">
    <input type="text" name="age" id="age" placeholder="Age" required>
  </div>
  <div class="field">
    <input type="text" name="address" id="address" placeholder="Address" required>
  </div>
  <div class="field">
    <input type="password" name="password" id="password" placeholder="Password" required>
  </div>
  <div class="field">
    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
  </div>
  <div class="field btn">
    <div class="btn-layer"></div>
    <input type="submit" name="signup" value="Signup">
  </div>
</form>

<script>
  function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var age = document.getElementById("age").value;
    var address = document.getElementById("address").value;
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;

    if (!/^[A-Z][a-zA-Z]*$/.test(username)) {
      alert("Name should start with a capital letter");
      return false;
    }

    if (!email.includes("@")) {
      alert("Email should contain the @ symbol");
      return false;
    }

    if (!/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]+$/.test(password)) {
      alert("Password should contain at least one capital letter, one special character, and one number");
      return false;
    }

    if (password !== cpassword) {
      alert("Password and confirm password should match");
      return false;
    }

    if (!/^\d+$/.test(age)) {
      alert("Age should contain only numbers");
      return false;
    }

    // Additional validation logic if needed

    return true; // Submit the form if all validation passes
  }
</script>

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