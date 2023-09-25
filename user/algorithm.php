<?php
require "../db/connection.php";
session_start();
$userid = $_SESSION['userid'];

/*
Collect recently commented newsid at least 3 times
From those newsid, collect all userid who commented on that news except user id
*/
$query = "SELECT newsid FROM comments WHERE userid=$userid";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $newsId = $row['newsid'];
        echo "News ID: $newsId<br>";
        
        $userquery = "SELECT userid FROM comments WHERE newsid = $newsId AND userid != $userid";
        $userResult = mysqli_query($conn, $userquery);
        if ($userResult) {
            while ($userRow = mysqli_fetch_array($userResult)) {
                $users = $userRow['userid'];
                echo "User ID: $users<br>";
            }
        } else {
            echo "No other users commented on this news.<br>";
        }
    }
}else {
    echo "No recently commented news found.<br>";
}
?>
