<?php
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['submit'])){
    $categoryname=$_POST['cname'];
    $sql="INSERT INTO category (categoryname) VALUES ('$categoryname')";
    echo $categoryname;
    if(mysqli_query($conn, $sql)){
        echo "data stored";
}else{
    echo "error";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" type="text/css" href="../style/category.css">

</head>
<body>
<?php include 'sidebar.php';?>

<form action="#" method="POST">
<h2>Category</h2>

  <div class="form-group">
  <label for="cname">Category name:</label><br>
  <input type="text" id="cname" name="cname"><br>
  </div>

  <div class="field btn">
        <input type="submit" name="submit" value="submit">
    </div>
</form>

    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>delete</th>
        </tr>
        <?php
            $query="SELECT * FROM category";
            $result=mysqli_query($conn, $query);
            $data=mysqli_num_rows($result);
            if($data>0){
                while($row=mysqli_fetch_array($result)){
        
        
        ?>
        <tr>
            <td> <?php echo $row['categoryid']; ?> </td>
            <td> <?php echo $row['categoryname']; ?> </td>
            <td><button>Delete</button></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>

</body>
</html>