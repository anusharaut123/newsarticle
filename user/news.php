<?php
session_start();
require "../db/connection.php";
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: ../index.php');

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>News Website</title>
  <link rel="stylesheet" href="../style/stylee.css"> 
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
    <?php
      $query="SELECT news.newsid, news.category, news.authorname, news.title, news.introduction, news.description, news_image.imageid, news_image.newsid, news_image.imagename FROM news join news_image on news.newsid=news_image.newsid";
      $result=mysqli_query($conn, $query);
      $data= mysqli_num_rows($result);
      if($data>0){
          while($row=mysqli_fetch_array($result)){
      ?>
    <div  class="news-container">
      <div class="news-detail">
        <h3> <?php echo $row['news.title']; ?> </h3>
        <p><?php echo $row['news.introduction']; ?> </p>
        <a href="fullnews.php">Read More</a>
      </div>
      <div>
        <img style="height:100px; width:170px;" src="../images/<?php echo $row['news_image.imagename']; ?>" alt="News Image >
      </div>
    </div>

    <?php
          }
      }
      ?>

</div>

  <?php
include('../include/footer.php');
?>
</body>
</html>