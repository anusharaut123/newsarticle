<?php
session_start();
require "../db/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['submit'])) {
        if (isset($_POST['opwd']) &&
        isset($_POST['npwd']) &&
        isset($_POST['cpwd'])) {
            $oldPassword = $_POST['opwd'];
            $newPassword = $_POST['npwd'];
            $confirmPassword = $_POST['cpwd'];

            if ($newPassword == $confirmPassword) {
                $hashedPassword = md5($oldPassword);
                $userid=$_SESSION['userid'];
                $query = "SELECT password FROM userdata WHERE id='$userid' LIMIT 1";
                $result = mysqli_query($conn, $query);
                $newPassword=md5($newPassword);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Verify password
                    if ($hashedPassword==$row['password']) {
                        $sql="UPDATE userdata SET password='$newPassword' WHERE id='$userid'";
                        mysqli_query($conn, $sql);
                    }
                }
            }
        }
    }
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changed Password</title>
    <link rel="stylesheet" href=../style/myprofile.css>
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
          <li><a href="renews.php">News</a></li>
          <li><a href="userlogout.php">Log out</a></li>
          
        </ul>
    </div>
    </div>
  </div>
<div class="container">
    <form action="#" method="POST">
<h2>Change Password</h2>

    <div class="form-group">
  <label for="opwd">Old Password:</label><br>
  <input type="text" id="opwd" name="opwd"><br>
  </div>

  <div class="form-group">
  <label for="npwd">New Password:</label><br>
  <input type="text" id="npwd" name="npwd"><br>
  </div>

  <div class="form-group">
  <label for="cpwd">Confirm Password:</label><br>
  <input type="text" id="cpwd" name="cpwd"><br>
  </div>

  <div class="field btn">
        <input type="submit" name="submit" value="submit">
    </div>
</div>
</form>
</div>
</body>
</html>