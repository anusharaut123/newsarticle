<?php
session_start();
require "../db/connection.php";
if (!isset($_SESSION['userid'])) {
  // Redirect to the login page or handle unauthorized access as needed
  header("Location: login.php");
  exit();
}

$userid = $_SESSION['userid'];

// Fetch user data from the database
$sql = "SELECT name, email, age, gender FROM userdata WHERE id='$userid'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $userData = mysqli_fetch_assoc($result);
  $name = $userData['name'];
  $email = $userData['email'];
  $age = $userData['age'];
  $gender = $userData['gender'];
} else {
  // Handle the error if the query fails
  echo '<script> alert("Error fetching user data.") </script>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
    if (isset($_POST['fname']) &&
        isset($_POST['gender']) && isset($_POST['email']) &&
        isset($_POST['age'])) {
      
      $name = $_POST['fname'];
      $email = $_POST['email'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $userid=$_SESSION['userid'];

      $sql = "UPDATE userdata SET name='$name', email='$email', age='$age', gender='$gender' WHERE id='$userid'";
      
      if (mysqli_query($conn, $sql)) {
        echo '<script> alert("Profile data saved successfully.") </script>';
      } else {
        echo '<script> alert("Error saving profile data.") </script>';
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
    <title>Edit Profile</title>
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
          <li><a href="renews.php">News</a></li>
          <li><a href="userlogout.php">Log out</a></li>
          
        </ul>
    </div>
    </div>
  </div>
  <div class="container">
  <form action="#" method="POST">
    <h2>Edit Profile</h2>
    <div class="form-group">
      <label for="fname">Name:</label><br>
      <input type="text" id="fname" value="<?php echo $name; ?>" name="fname"><br>
    </div>

    <div class="form-group">
      <label for="email">Email:</label><br>
      <input type="text" id="email" value="<?php echo $email; ?>" name="email"><br>
    </div>

    <div class="form-group">
      <label for="age">Age:</label><br>
      <input type="text" id="age" value="<?php echo $age; ?>" name="age"><br>
    </div>

    <label for="gender">Gender:</label>
    <div class="gender-options">
      <input type="radio" id="male" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>>
      <label for="male">Male</label>

      <input type="radio" id="female" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>>
      <label for="female">Female</label>

      <input type="radio" id="other" name="gender" value="Other" <?php if ($gender == "Other") echo "checked"; ?>>
      <label for="other">Other</label>
    </div>
    <br>
    <input type="submit" name="submit" value="Edit Profile">
  </form>
</div>
</body>
</html>