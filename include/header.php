<?php
session_start();
extract($_REQUEST);

#include 'productdb.php'; 

/* in if condition i removed ! so not set value only check and session mail is valid email too */
if (isset($_SESSION['email']) && $_SESSION['email'] == "anusharaut424@gmail.com") {
  #header("location:index.php");
  //echo "YOU ARE ADMIN....";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard of NRS</title>
  <link rel="stylesheet" href="style/dashboard.css">
</head>

<body>
  <div class="wrap">
    <div class="sidebar">
      <h1>DASHBOARD</h1>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Product</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="logout.php"> <?php session_destroy(); ?>Log out</a></li>
      </ul>
    </div>
    <section class="main">
      <h1>WELCOME TO NRS</h1>
      
    </section>
  </div>
  <footer class="foot">
    <div class="copyright" style=" position: relative; left: 0; bottom: 0; width: 100%; text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
      <div class="container">

        <p>Copyright &copy; <script>
            document.write(new Date().getFullYear())
          </script> NRS All Rights Reserved</p>
      </div>
    </div>
  </footer>
</body>

</html>