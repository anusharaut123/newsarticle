<?php
session_start();
require "../db/connection.php";
if (!isset($_COOKIE['auth']) && $_COOKIE['auth'] != "admintrue") {
  header('location: admin_login.php');
}
require "validatenews.php";
?>

<html>

<head>
  <title>Add News</title>
  <link rel="stylesheet" type="text/css" href="../style/addnews.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div classname="newsbody col-md-4" style="margin-left: 540px; margin-right:680px; background-color:pink; ">
      <form action="#" method="POST" enctype="multipart/form-data"  style="  background-color:pink; width: 580px; padding:30px;">
        <h1>Add News</h1>
        <hr style="color: black;">
        <label for="category">Categories:</label>
          <select id="category" name="category">
        <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($conn, $query);
            $data = mysqli_num_rows($result);
            if ($data > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  if($row['state'] != 'block'){
          ?>
                    <option value=<?php echo $row['categoryid']; ?>><?php echo $row['categoryname']; ?></option>
          <?php
                  }
                }
            }
          ?>
        </select>

        <div class="form-group">
          <label for="author">Author Name: <?php if(isset($authorerror)) echo $authorerror; ?></label>
          <input type="text" class="form-control" name="author" id="author">
        </div>
        <div class="form-group">
          <label for="title">Title: <?php if(isset($titleerror)) echo $titleerror; ?></label>
          <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
          <label for="introduction">Short description: <?php if(isset($shortdescriptionerror)) echo $shortdescriptionerror; ?></label>
          <textarea class="form-control" name="shortdescription" id="shortdescripttion"></textarea>
        </div>
        <div class="category-image">
          <label for="image">Image <?php if(isset($imageerror)) echo $imageerror; ?></label>
          <br>
          <br>
          <button type="button" name="image" class="plus-button" id="add-image">
            <i class="fas fa-plus"></i> +
          </button>
          <input type="file" name="images[]" id="image" multiple />
          <ul id="image-list"></ul>
          <div id="image-container"></div>
        </div>
        <label for="description">Description: <?php if(isset($descriptionerror)) echo $descriptionerror; ?></label>
        <textarea class="form-control" rows="5" name="description" id="description"></textarea>

        <input type="submit" name="newssubmit" class="btn btn-primary" value="Add News">
      </form>
    </div>
 


</body>

<script>
  $(document).ready(function() {
    $('#add-image').click(function() {
      var imageInput = $('#image').clone();
      $('#image-container').append(imageInput);
    });
  });
</script>

</html>