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
  <h1>Delete Account</h1>
  <div class="form-group">
  <label for="cname">Name:</label><br>
  <input type="text" id="cname" name="cname"><br>
  </div>
  <p>Are you sure you want to delete your account? </p>
  
  <form action="/delete-account" method="post">
    <button type="submit">Delete Account</button>
  </form>
  
</body>
</html>
