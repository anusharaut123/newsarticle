<?php
require "../db/connection.php";
session_start();
$userid = $_SESSION['userid'];

/*
Collect recently commented newsid at least 3 times
From those newsid, collect all userid who commented on that news except user id
from those user id collect news id;
*/
$query = "SELECT newsid FROM comments WHERE userid=$userid";
$result = mysqli_query($conn, $query);
$collectNewsId = array();
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $newsId = $row['newsid'];
        // echo "News ID: $newsId<br>";
        
        $userquery = "SELECT userid FROM comments WHERE newsid = $newsId AND userid != $userid";
        $userResult = mysqli_query($conn, $userquery);
        if ($userResult) {
            while ($userRow = mysqli_fetch_array($userResult)) {
                $users = $userRow['userid'];
                // echo "userid->".$users."<br>";
                $newsArticleQuery = "SELECT newsid from comments WHERE userid='$users'";
                $articleResult = mysqli_query($conn, $newsArticleQuery);
                if($articleResult) {
                    while($articleRow = mysqli_fetch_array($articleResult)) {
                        $articleId = $articleRow['newsid'];
                        // echo "article-->".$articleId."<br>";
                        array_push($collectNewsId, $articleId);
                    }
                }
            }
        } else {
            echo "No other users commented on this news.<br>";
        }
    }
}else {
    echo "No recently commented news found.<br>";
}

// from collection of newid select data which are a week old and have high views
$collectNewsId = array_unique($collectNewsId);
// print_r($collectNewsId);

$placeholders = rtrim(str_repeat('?,', count($collectNewsId)), ',');
$sql = "SELECT *, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename, (SELECT categoryname from category where news.category = category.categoryid ) as categoryname FROM news WHERE newsid IN ($placeholders) AND date >= NOW() - INTERVAL 7 DAY ORDER BY date DESC, views DESC LIMIT 3";


$stmt = mysqli_prepare($conn, $sql);

$types = str_repeat('i', count($collectNewsId));
mysqli_stmt_bind_param($stmt, $types, ...$collectNewsId);

mysqli_stmt_execute($stmt);
$recommedationResult = array();
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_num_rows($result);
if($data == 3){
    while ($newDetailRow = mysqli_fetch_row($result)) {
        array_push($recommedationResult, $newDetailRow);
        // echo "<br>";
        // print_r($newDetailRow);
    }
} else {
    $zeroSql = "SELECT *, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename, (SELECT categoryname from category where news.category = category.categoryid ) as categoryname FROM news WHERE date >= NOW() - INTERVAL 14 DAY ORDER BY date DESC, views DESC LIMIT 3";
    $zeroStmt = mysqli_prepare($conn, $zeroSql);
    mysqli_stmt_execute($zeroStmt);
    $result = mysqli_stmt_get_result($zeroStmt);
    while ($newDetailRow = mysqli_fetch_row($result)) {
        array_push($recommedationResult, $newDetailRow);
        // echo "<br>";
        // print_r($newDetailRow);
    }
}

mysqli_stmt_close($stmt);
?>