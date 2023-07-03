<?php
session_start();
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard of NRS</title>
  <link rel="stylesheet" href="../style/dashboard.css">
</head>

<body>
  <div class="wrap">
    <div class="sidebar">
      <h1>DASHBOARD</h1>
      <ul>
        <li><a href="admin/adminhome.php">Home</a></li>
        <li><a href="category.php">Category</a></li>
        <li><a href="addnews.php">Add News</a></li>
        <li><a href="#">User</a></li>
        <li><a href="logoutadmin.php">Log out</a></li>
      </ul>
    </div>
    <section class="main">
      <h1>WELCOME TO NRS</h1>
      
    </section>
  </div>
  <?php
include('../include/footer.php');
?>
</body>

</html>