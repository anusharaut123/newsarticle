
<?php
session_start();
$newsid = $_GET['newsid'];
require "../db/connection.php";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['submit'])){
        $userid = $_SESSION['userid'];
        $username=$_SESSION['username'];
        $comment=$_POST['comment'];
        unset($_POST);
        $sql = "INSERT INTO comments (userid, newsid, name, comment) VALUES ('$userid', '$newsid', '$username', '$comment')";
        if(mysqli_query($conn, $sql)){ 
          echo "Comment added successfully.";
        } else {
          echo "Error";
        }
      }
  }
  $query = "SELECT * FROM news WHERE newsid='$newsid' LIMIt 1";
  $newsresult = mysqli_query($conn, $query);
  $newsdata = mysqli_fetch_array($newsresult);
  $newsViews=$newsdata['views'];
  $view=intval($newsViews)+1;
  $updateQuery = "UPDATE news SET views='$view' WHERE newsid='$newsid'";
  mysqli_query($conn, $updateQuery);
?>
<!DOCTYPE html>
<html>
<head>
  <title>News Article</title>
  <link rel="stylesheet" href="../style/stylee.css"> 
  <style>
    /* CSS styles for the news article */
.article {
  margin-bottom: 30px;
  border: 1px solid #ddd;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

.author {
  font-size: 16px;
  color: #888;
  margin-bottom: 10px;
}

.date {
  font-size: 16px;
  color: #888;
  margin-bottom: 15px;
}

.content {
  font-size: 18px;
  line-height: 1.6;
  margin-top: 20px;
  color: #444;
}

.image {
  max-width: 100%;
  margin-bottom: 20px;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-top: 30px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 10px;
  color: #555;
}

textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border: none;
  border-radius: 5px;
  transition: background-color 0.3s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
}

  </style>
</head>
<body>  <header>
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
    <div class="form-group">
      <form action="fullnews.php?newsid=<?php echo $newsid ?>" method="post">
        <label for="comment">Comment:</label>
        <textarea class="form-control" rows="7" cols="50" name="comment" id="comment"></textarea><br>
        <input type="submit" name="submit" class="btn btn-primary" value="Comment">
      </form>
    </div>
    <?php
      $sql = "SELECT name, comment FROM comments WHERE newsid='$newsid'";
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
