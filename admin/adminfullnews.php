
<?php
session_start();
$newsid = $_GET['newsid'];
require "../db/connection.php";
$query = "SELECT * FROM news WHERE newsid='$newsid' LIMIt 1";
$newsresult = mysqli_query($conn, $query);
$newsdata = mysqli_fetch_array($newsresult);

?>
<!DOCTYPE html>
<html>
<head>
  <title>News Article</title>
  <style>
    /* CSS styles for the news article */
    .article {
      margin-bottom: 20px;
      border: 1px solid #ccc;
      padding: 10px;
    }

    .title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .author {
      font-size: 14px;
      color: #888;
    }

    .date {
      font-size: 14px;
      color: #888;
      margin-bottom: 5px;
    }

    .content {
      margin-top: 10px;
    }

    .image {
      max-width: 100%;
      margin-bottom: 10px;
    }

    .form-group {
      margin-top: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    textarea {
      width: 50%;
      padding: 5px;
    }

    .btn {
      display: inline-block;
      padding: 8px 12px;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      border: none;
      border-radius: 4px;
    }

    .btn-primary {
      color: #fff;
      background-color: #007bff;
    }
  </style>
</head>
<body>
  <div class="article">
    <h2 class="title"><?php echo $newsdata['title']; ?></h2>
    <p class="author"><?php echo $newsdata['authorname']; ?></p>
    <p class="date">Saturday, July 8, 2023 </p>
    <?php
    $imageid = $newsdata['newsid'];
    $imagequery = "SELECT * FROM news_image WHERE newsid = '$imageid' LIMIT 3";
    $imageresult = mysqli_query($conn, $imagequery);
    $imagerow = mysqli_fetch_array($imageresult);
    ?>
    <img style="width: 100%; height: 500px" class="image" src="../admin/newsimage/<?php echo $imagerow['imagename'] ?>" alt="News Image">
    <div class="content">
      <p><?php echo $newsdata['introduction']; ?></p>
    </div>
    <?php $imagerow = mysqli_fetch_array($imageresult); ?>
    <img style="height: 350px; width: 725px;" class="image-left" src="../admin/newsimage/<?php echo $imagerow['imagename'] ?>" alt="Left Image">
    <?php $imagerow = mysqli_fetch_array($imageresult); ?>
    <img style="height: 350px; width: 725px;" class="image-right" src="../admin/newsimage/<?php echo $imagerow['imagename'] ?>" alt="Right Image">
    <div class="content">
      <p><?php echo $newsdata['description']; ?></p>
    </div>
    <h3>Comments</h3>
    <?php
      $sql = "SELECT name, comment FROM comments";
      $result=mysqli_query($conn, $sql);
      $data= mysqli_num_rows($result);
      if($data>0){
          while($row=mysqli_fetch_array($result)){
            echo '<div class="comment">';
            echo '<h4>' . $row['name'] . '</h4>';
            echo '<p>' . $row['comment'] . '</p>';
            echo '</div>';
        }
    }
    ?>
</body>
</html>
