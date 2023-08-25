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
      <li><a href="renews.php">Home</a></li>
      <?php
      $query="SELECT * FROM category";
      $result=mysqli_query($conn, $query);
      $data= mysqli_num_rows($result);
      if($data>0){
          while($row=mysqli_fetch_array($result)){
            if($row['state']!='block'){
      ?>
              <li><a href="news.php?categoryid=<?php echo $row['categoryid'] ?>"><?php echo $row['categoryname']; ?></a></li>
        <?php
            }
          }
        }
        ?>
      </ul>
    </nav>
  </header>
<div>
    <h2>Latest News</h2>
    <?php
      $categoryid = $_GET['categoryid'];
      if(isset($categoryid)){
        $query="SELECT news.newsid as newsid, news.category as category, news.authorname as authorname, news.title as title, news.introduction as introduction, news.description as description, news_image.imageid as imageid, news_image.newsid as newsid, news_image.imagename as imagename FROM news join news_image on news.newsid=news_image.newsid WHERE news.category='$categoryid'";
      }else{
        $query="SELECT news.newsid as newsid, news.category as category, news.authorname as authorname, news.title as title, news.introduction as introduction, news.description as description, news_image.imageid as imageid, news_image.newsid as newsid, news_image.imagename as imagename FROM news join news_image on news.newsid=news_image.newsid";
      }
      $result=mysqli_query($conn, $query);
      $data= mysqli_num_rows($result);
      if($data>0){
          while($row=mysqli_fetch_array($result)){
      ?>
    <div  class="news-container">
      <div class="news-detail">
        <h3> <?php echo $row['title']; ?> </h3>
        <p><?php echo $row['introduction']; ?> </p>
        <a href="fullnews.php?newsid=<?php echo $row['newsid']; ?>">Read More</a>
      </div>
      <div>
        <img style="height:100px; width:170px;" src="../admin/newsimage/<?php echo $row['imagename']; ?>" alt="News Image" >
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