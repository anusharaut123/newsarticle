<?php
session_start();
require "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['submit'])){
      $password = $_POST['password'];
      $userid = $_SESSION['userid'];

      if (empty($password)) {
          echo "Password field is required.";
          exit;
      }

      $query = "SELECT password FROM userdata WHERE id='$userid' AND password='$password' LIMIT 1";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_assoc($result);

          $sql = "DELETE FROM userdata WHERE id='$userid'";
          if (mysqli_query($conn, $sql)) {
              echo "User deleted successfully";
          } else {
              echo "Error deleting record: " . mysqli_error($conn);
          }
      } else {
          echo "Invalid password";
      }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Account</title>
  <link rel="stylesheet" type="text/css" href="../style/delete.css">
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
  <h2>Delete Your Account</h2>
    <form action="#" method="post">    
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required><br><br>
        <input type="submit" value="Delete Account">
    </form>
  
</body>
</html>
