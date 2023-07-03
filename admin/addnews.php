<?php
session_start();
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}
require "validatenews.php";
?>
<html>
  <head>
    <title>Add News</title>
    <link rel="stylesheet" type="text/css" href="../style/addnews.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
<body>
  
<form action="#" method="POST" enctype="multipart/form-data">
<h1>Add News</h1>
<hr>
<label for="category" >Categories:</label>
<select id="category" name="category">
  <option value="entertainment">Entertainment</option>
  <option value="sports">Sports</option>
  <option value="business">Bussiness</option>
</select>

<div class="form-group">
  <label for="author">Author Name:</label>
  <input type="text" class="form-control" name="author" id="author">
</div>
<div class="form-group">
  <label for="title">Title:</label>
  <input type="text" class="form-control" name="title" id="title">
</div>
<div class="form-group">
  <label for="introduction">Short description:</label>
  <textarea class="form-control" name="shortdescription" id="shortdescripttion"></textarea>
</div>
<div class="category-image">
  <label for="image">Image</label>
  <button type="button" name="image" class="plus-button" id="add-image">
  <i class="fas fa-plus"></i> +
</button>
  <input type="file" name="images[]" id="image" multiple /> 
  <ul id="image-list"></ul>
  <div id="image-container"></div>
</div>
  <label for="description">Description:</label>
  <textarea class="form-control" rows="5" name="description" id="description"></textarea>
</div>

<input type="submit" name="newssubmit" class="btn btn-primary" value="Add News">
</form>
</div>

<?php
include('../include/footer.php');
?>
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
