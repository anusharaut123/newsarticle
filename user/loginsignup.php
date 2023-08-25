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
        $signupErrors = null;
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $signupErrors['email'] = "Invalid email address";
      }

      if (empty($username)) {
          $signupErrors['username'] = "Username is required";
      }

      if (empty($password) || strlen($password) < 6) {
          $signupErrors['password'] = "Password must be at least 6 characters";
      } elseif ($password != $cpassword) {
          $signupErrors['cpassword'] = "Passwords do not match";
      }

      if ($signupErrors == null) {
          // If there are no validation errors, proceed with database insertion
          $hashedPassword = md5($password);
          $query = "INSERT INTO userdata (name, email, age, address, gender, password) VALUES ('$username', '$email', '$age', '$address', '$gender', '$hashedPassword')";
          $execute = mysqli_query($conn, $query);
          if ($execute) {
              header("Refresh:0");
          } else {
              echo "Not executed";
          }
      }
  }
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
 
        if (empty($email) || empty($password)) {
          $error = "Both email and password are required.";
      } else {
          // Sanitize input data
          
          $hashedPassword = md5($password);
          $query = "SELECT id, name, email, age, address, gender, password, state FROM userdata WHERE email='$email' LIMIT 1";
          $result = mysqli_query($conn, $query);
  
          if ($row = mysqli_fetch_assoc($result)) {
              // Verify password
              if ($hashedPassword==$row['password'] && $row['state'] != 'block') {
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['name'];
                  $_SESSION['useremail'] = $row['email'];
                  $_SESSION['userage'] = $row['age'];
                  $_SESSION['useraddress'] = $row['address'];
                  $_SESSION['usergender'] = $row['gender'];
                  $_SESSION['usersessionid'] = session_id();
                  setcookie('userauth', 'true', time() + 18000);
                  header('location: myprofile.php');
                  exit();
              } else {
                  $error = "Invalid email or password1.";
                  echo $hashedPassword.'::'.$row['password'];
              }
          } else {
              $error = "Invalid email or password.";
          }
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
            <?php if (isset($error)) : ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
        </form>
        
        <form action="#" class="signup" method="post" onsubmit="return validateForm()">
        <div class="field">
          <input type="text" name="username" id="username" placeholder="Username" required>
          <?php if (isset($signupErrors['username'])) { ?>
          <p class="error"><?php echo $signupErrors['username']; ?></p>
          <?php } ?>
        </div>
        <div class="field">
        <input type="email" name="email" id="email" placeholder="Email" required>
          <?php if (isset($signupErrors['email'])) { ?>
          <p class="error"><?php echo $signupErrors['email']; ?></p>
          <?php } ?>
        </div>
        <div class="field">
          <input type="text" name="age" id="age" placeholder="Age" required>
        </div>
        <div class="field">
          <input type="text" name="address" id="address" placeholder="Address" required>
        </div>
        <div class="field">
          <input type="text" name="gender" id="gender" placeholder="Gender" required>
        </div>
        <div class="field">
          <input type="password" name="password" placeholder="Enter Password" required>
          <?php if (isset($signupErrors['cpassword'])) { ?>
          <p class="error"><?php echo $signupErrors['cpassword']; ?></p>
          <?php } ?>
        </div>
        <div class="field">
          <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
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