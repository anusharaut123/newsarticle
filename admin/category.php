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
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Style the form container */
        .form-group {
            background-color: aqua;
            width: 50%;
            margin: auto;
            padding: 20px;
        }

        /* Style the form elements */
        label {
            font-size: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005F7F;
        }

        /* Style the table */
        table {
            width: 100%;
            font-size: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style the "Block" button */
        .block-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .block-button.green {
            background-color: lightgreen;
        }

        /* Center align elements */
        .center {
            text-align: center;
        }
    </style>
    

</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="form-group aaa margin-left: 300px;">
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