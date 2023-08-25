
<?php
session_start();
require "../db/connection.php";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $comment=$_POST['comment'];
        $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
        if(mysqli_query($conn, $sql)){ 
          echo "Comment added successfully.";
        } else {
          echo "Error";
        }
      }
      $sql = "SELECT name, comment FROM comments";
      $result=mysqli_query($conn, $query);
      $data= mysqli_num_rows($result);
      if($data>0){
          while($row=mysqli_fetch_array($result)){
            echo '<div class="comment">';
            echo '<h4>' . $row['name'] . '</h4>';
            echo '<p>' . $row['comment'] . '</p>';
            echo '</div>';
        }
    }
  }

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
    <h2 class="title">News Article Title</h2>
    <p class="author">Author Name</p>
    <p class="date">Saturday, July 8, 2023 </p>
    <img style="width: 100%; height: 800px" class="image" src="../images/business-news-vector-1227754.jpg" alt="News Image">
    <div class="content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
      <p>Donec venenatis est eu dolor feugiat, in commodo lectus malesuada. Curabitur in consectetur sem. Integer facilisis, ipsum nec dapibus ullamcorper, erat justo tincidunt metus, in lacinia mauris odio vel nisl. Quisque sollicitudin, nisl vel facilisis convallis, urna elit feugiat magna, in suscipit nunc sem eu orci.</p>
    </div>
    <img style="height: 350px; width: 725px;" class="image-left" src="../images/newspaper-template-design-vector-18862843.webp" alt="Left Image">
    <img style="height: 350px; width: 725px;" class="image-right" src="../images/background-image.jpg" alt="Right Image">
    <div class="content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et volutpat felis. Nulla pulvinar auctor erat, vel fringilla ligula ultrices nec. Proin vehicula fringilla elit, vitae pellentesque mi sollicitudin non. Sed tempus, felis sit amet accumsan faucibus, risus urna imperdiet nunc, a tristique mauris lectus at mauris.</p>
    </div>
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea class="form-control" rows="7" cols="50" name="comment" id="comment"></textarea><br>
      <input type="submit" name="comment" class="btn btn-primary" value="Comment">
    </div>

    <div class="comment">
        <h4>Anusha Raut</h4>
        <p>This is a great article. I really enjoyed reading it!</p>
    </div>
    
    <div class="comment">
        <h4>Sanish Shrestha</h4>
        <p>Thanks for sharing this information. It's very helpful.</p>
    </div>
        <form>
        <h4>Add your comment:</h4>
        <input type="text" id="name" name="name" placeholder="Your name" required><br>
        <textarea id="comment" name="comment" placeholder="Your comment" required></textarea><br>
        <button type="submit" id="submit" name="submit">Submit</button>
    </form>

  </div>
</body>
</html>
