<?php
require_once "../db/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $categoryname = $_POST['cname'];

        if (empty($categoryname)) {
            echo '<script>alert("Category name cannot be empty")</script>';
        } else {

        $sql = "INSERT INTO category (categoryname) VALUES ('$categoryname')";
        if (mysqli_query($conn, $sql)) {
            unset($_POST);
            echo '<script>alert("successfully inserted")</script>';
            header("Refresh: 0");
        } else {
            echo "error";
        }
    }
}
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['categoryid']) && $_GET['state']) {
        $categoryid = $_GET['categoryid'];
        if($_GET['state']== "none"){
            $state = "block";
        }else if($_GET['state']== "block"){
            $state = "none";
        }else{
            exit;
        }
        $query = "UPDATE category set state='$state' WHERE categoryid = '$categoryid'";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("successful")</script>';
            header('Location: category.php');
        } else {
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
    <style>
        .form-group{
           background-color: aqua;
           width: 50%;
           margin: auto;
           height: 300px;
           margin-top: 20px;
        }

        table{
            width: 100%;
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
    

</head>

<body>
    <div class="sidebar" style="width: 20%;">
        <?php include 'sidebar.php'; ?>
    </div>


    <div class="form-group aaa">
        <form action="#" method="POST" style="width: 50%; margin:auto;">
            <h2>Category</h2>
            <label for="cname">Category name:</label><br>
            <input type="text" id="cname" name="cname"><br>
   

    <div class="field btn">
        <input type="submit" name="submit" value="submit">
    </div>
    </form>
    <div class="wrap" style="width: 50%; margin:auto;">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($conn, $query);
            $data = mysqli_num_rows($result);
            if ($data > 0) {
                while ($row = mysqli_fetch_array($result)) {


            ?>
                    <tr>
                        <td> <?php echo $row['categoryid']; ?> </td>
                        <td> <?php echo $row['categoryname']; ?> </td>
                        <td>
                            <a href="category.php?categoryid=<?php echo $row['categoryid'].'&state='.$row['state'] ?>"><button style="background-color: <?php echo $row['state']=='block' ? 'red' : 'lightgreen'; ?>">Block</button></a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
    </div>
<?php echo "cat"; ?>
</body>

</html>