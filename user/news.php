<?php
session_start();
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>News Website</title>
  <link rel="stylesheet" href="../style/stylee.css"> <!-- Link to your CSS file -->
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
  <header>
    <h1>News Website</h1>
    <nav>
      <ul>
        <li><a href="news.php">Home</a></li>
        <li><a href="business.php">Business</a></li>
        <li><a href="sport.php">Sports</a></li>
        <li><a href="entertainment.php">Entertainment</a></li>
        <li><a href="userprofile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
<div>
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


    </section>

</div>

  <?php
include('../include/footer.php');
?>
</body>
</html>