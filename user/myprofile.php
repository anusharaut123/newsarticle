<?php
session_start();
require "../db/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
    if (isset($_POST['fname']) && isset($_POST['lname']) &&
        isset($_POST['gender']) && isset($_POST['email']) &&
        isset($_POST['age'])) {
      
      $firstname = $_POST['fname'];
      $lastname = $_POST['lname'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];

      $sql = "INSERT INTO udata (firstname, lastname, email, age, gender) VALUES ('$firstname', '$lastname', '$email', '$age', '$gender')";
      
      if (mysqli_query($conn, $sql)) {
        echo "Profile data saved successfully.";
      } else {
        echo "Error saving profile data.";
      }
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
    <form action="#" method="POST">
    <h2>My Profile</h2>
<div style="background-image: url('images');
  background-size: cover; height: 100px;">
<img src="../images/pexels-pixabay-268533.jpg" style="height:100px;">
</div>

<div class="form-group">
  <p>User Name: <?php echo $_SESSION['username'] ?></p>
</div>

<div class="form-group">
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname"><br>
</div>

<div class="form-group">
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
</div>

<div class="form-group">
  <label for="age">Age:</label><br>
  <input type="text" id="age" name="age"><br>
</div>

<label for="gender">Gender:</label>
<div class="gender-options">
  <input type="radio" id="male" name="gender" value="Male">
  <label for="male">Male</label>

  <input type="radio" id="female" name="gender" value="Female">
  <label for="female">Female</label>

  <input type="radio" id="other" name="gender" value="Other">
  <label for="other">Other</label>
</div>

  <br>
  <input type="submit" name="submit" value="Save">
 
</form>
</div>
</body>
</html>