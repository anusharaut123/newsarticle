<?php
session_start();
require "../db/connection.php";
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
  <style>
    .news-container {
      display: flex;
      justify-content: center;
      margin-right: 10px;
      margin-left: 10px;
    }

    .news-container .news-detail {
      flex-grow: 3;
    }
  </style>
</head>

<body>

<?php include 'sidebar.php';?>
    <div class="wrap">
    <div class="body">
      <h2>Latest News</h2>
      <div  class="news-container">
        <div class="news-detail">
          <h3>News Title</h3>
          <p>News content goes here.</p>
          <a href="fullnews.php">Read More</a>
        </div>
        <div>
          <img style="height:100px; width:170px;" src="../images/download.jpg" alt="News Image">
        </div>
      </div>

      <div class="news-container">
        <div class="news-detail">
          <h3>News Title</h3>
          <p>News content goes here.</p>
          <a href="#">Read More</a>
        </div>
        <div>
          <img style="height:100px; width:170px;" src="../images/background-image.jpg" alt="News Image">
        </div>
      </div>
    </div>
  </div>

 </body>

</html>