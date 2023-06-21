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
    <link ref="stylesheet" type="text/css" href="style/addnews.css">
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
  <label for="news">News:</label>
  <input type="text" class="form-control" name="news" id="news">
</div>
<div class="form-group">
  <label for="title">Title:</label>
  <input type="text" class="form-control" name="title" id="title">
</div>
<div class="form-group">
  <label for="introduction">Introduction:</label>
  <textarea class="form-control" name="introduction" id="introduction"></textarea>
</div>
<label for="image1">Upload Image:</label>
<input type="file" id="image1" name="image1">
<div class="form-group">
  <label for="description">Description:</label>
  <textarea class="form-control" rows="5" name="description" id="description"></textarea>
</div>
<label for="image"2>Upload Image:</label>
<input type="file" id="image2" name="image2">
<div class="form-group">
  <label for="conclusion">Conclusion:</label>
  <textarea class="form-control" name="conclusion" id="conclusion"></textarea>
</div>
<input type="submit" name="newssubmit" class="btn btn-primary" value="Add News">
</form>
</div>

<?php
include('include/footer.php');
?>
</body>
</html>
