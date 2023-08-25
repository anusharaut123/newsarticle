<?php
session_start();
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: ../index.php');
}
?>

<html>

<head>
 
  <style>
   

    .main {

      background-position: center;
      background-size: cover;
      background-color: #fbf2e3;
    }

    .navbar {
      width: 1200px;
      height: 100px;
      margin: auto;
    }

    .icon {
      width: 500px;
      float: left;
      height: 70px;

    }

    
    .menu {
      width: 700px;
      float: left;
      height: 70px;

      /* position: fixed; */

    }

    ul {
      float: left;
      display: flex;
      justify-content: center;
      align-items: center;

    }

    ul li {
      list-style: none;
      margin-left: 62px;
      margin-top: 27px;
      font-size: 20px;
    }

    ul li a {
      text-decoration: none;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bold;
      transition: 0.4s ease-in-out;
      color: black;
    }

    ul li a:hover {
      color: royalblue;
    }

    

    ul li :hover ul li{
    display: block;
    position: absolute;
    margin-top: 15px;
    margin-left: -15px;
}

  </style>
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
      <div>
        <?php echo "welcome ".$_SESSION['username'] ?>
      </div>
</body>

</html>