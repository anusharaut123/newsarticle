<?php
session_start();
require "../db/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../style/myprofile.css">
</head>
<body>
<div class="main">
    <div class="navbar">
    <div class="icon">
        <h1 class="container">Profile</h1>
    </div>
    <div class="menu">
        <ul>
          <li><a href="myprofile.php">My profile</a></li>
          <li><a href="editprofile.php">Edit profile</a></li>
          <li><a href="changepassword.php">Change Password</a></li>
          <li><a href="delete.php">Delete</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="userlogout.php">Log out</a></li>
          
        </ul>
    </div>
    </div>
  </div>
  <div class="container">
    <h2>My Profile</h2>
<div style="background-image: url('images');
  background-size: cover; height: 100px;">
<img src="../images/pexels-pixabay-268533.jpg" style="height:100px;">
</div>

<div class="form-group">
  <p>User Name: <?php echo $_SESSION['username'] ?></p>
</div>
<div class="form-group">
<p>Age: <?php echo $_SESSION['userage'] ?></p>
</div>

<div class="form-group">
<p>Address: <?php echo $_SESSION['useraddress'] ?></p>
</div>
<div class="form-group">
<p>Gender: <?php echo $_SESSION['usergender'] ?></p>
</div>


</div>
</body>
</html>