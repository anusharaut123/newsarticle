<?php
session_start();
require "../db/connection.php";
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../style/dashboard.css">
  

</head>
<body>
    <?php include 'sidebar.php';?>

  <div>
    <h2>Users</h2>

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
            <td><button>Delete</button></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>

  </div>

</body>
</html>
