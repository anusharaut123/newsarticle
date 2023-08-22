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
      <?php
            $query = "SELECT news.newsid as newsid, news.title as title, news.introduction as introduction, news_image.imagename as imagename FROM news join news_image on news.newsid=news_image.newsid";
            $result = mysqli_query($conn, $query);
            $data = mysqli_num_rows($result);
            if ($data > 0) {
                while ($row = mysqli_fetch_array($result)) {
      ?>
      <div  class="news-container">
        <div class="news-detail">
          <h3><?php echo $row['title']; ?></h3>
          <p><?php echo $row['introduction']; ?></p>
          <a href="fullnews.php">Read More</a>
        </div>
        <div>
          <img style="height:100px; width:170px;" src="newsimage/<?php echo $row['imagename']; ?>" alt="News Image">
        </div>
      </div>
      <?php
                }
              }
      ?>
    </div>
  </div>

 </body>

</html>