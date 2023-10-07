<?php
session_start();
require "../db/connection.php";
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['userid']) && $_GET['state']) {
        $userid = $_GET['userid'];
        if($_GET['state']== "none"){
            $state = "block";
        }else if($_GET['state']== "block"){
            $state = "none";
        }else{
            exit;
        }
        $query = "UPDATE userdata set state='$state' WHERE id = '$userid'";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("successful")</script>';
            header('Location: muser.php');
        } else {
            echo "error";
        }
        
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../style/dashboard.css">
  <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    .wrap {
      margin-left: 250px;
      padding: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Style for the delete button */
    button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #c82333;
    }
    
    table {
        padding: 20%;
        height: 90px;
        width: 100%;
    }
    
    .table {
        height: 500px;
        width: 100%;
    }
</style>

</head>
<body>
   <div class="sidebar" >
   <?php include 'sidebar.php';?>
   </div>
  
  <div class="wrap" >
  <h2>Users</h2>
  <div class="table">
  <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>age</th>
            <th>address</th>
            <th>gender</th>
            <th>delete</th>
        </tr>
        <?php
            $query="SELECT * FROM userdata";
            $result=mysqli_query($conn, $query);
            $data=mysqli_num_rows($result);
            if($data>0){
                while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['Name']; ?> </td>
            <td> <?php echo $row['email']; ?> </td>
            <td> <?php echo $row['age']; ?> </td>
            <td> <?php echo $row['address']; ?> </td>
            <td> <?php echo $row['gender']; ?> </td>
            <td><a href="muser.php?userid=<?php echo $row['id'].'&state='.$row['state'] ?>">
                <button style="background-color: <?php echo $row['state']=='block' ? '#dc3545' : 'green'; ?>">Block</button>
            </a></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
  </div>
  </div>

</body>
</html>
