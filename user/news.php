<?php
session_start();
require "../db/connection.php";
if(!isset($_COOKIE['userauth']) && $_COOKIE['userauth']!="true"){
  header('location: ../index.php');

}
$category=$_GET['category'];
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
            $query = "SELECT * FROM category WHERE state != 'block'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '<li><a href="news.php?category=' . $row['categoryid'] . '">' . $row['categoryname'] . '</a></li>';
                }
            }
            ?>
        <li><a href="myprofile.php">Profile</a></li>
        <li><a href="userlogout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
<div>
    <h2>Latest News</h2>
    <?php
      $query="SELECT news.newsid as newsid, news.category as category, news.authorname as authorname, news.title as title, news.introduction as introduction, news.description as description, (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid) as imageid, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename FROM news WHERE news.category='$category';";
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