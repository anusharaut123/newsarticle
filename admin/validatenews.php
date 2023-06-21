<?php
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['newssubmit'])){
        $category=$_POST['category'];
        $authorname=$_POST['author'];
        $news=$_POST['news'];
        $title=$_POST['title'];
        $introduction=$_POST['introduction'];
        $description=$_POST['description'];
        $conclusion=$_POST['conclusion'];

        $tempimage1 = explode(".", $_FILES["image1"]["name"]);
        $newfilename = round(microtime(true)).".".end($tempimage1);
        $fileType = end($tempimage1);
        $allowTypes = array('jpg','png','jpeg');

        $tempimage2 = explode(".", $_FILES["image2"]["name"]);
        $newfilename2 = round(microtime(true)).".".end($tempimage2);
        $fileType2 = end($tempimage2);
        $allowTypes2 = array('jpg','png','jpeg');

        if(in_array($fileType,$allowTypes) && in_array($fileType2,$allowTypes2)){
            $query="INSERT INTO news (category, authorname, news, title, introduction, image1, description, image2, conclusion) VALUES('$category', '$authorname', '$news', '$title', '$introduction', '$newfilename', '$description', '$newfilename2', '$conclusion')";
            if(mysqli_query($conn, $query)){
                move_uploaded_file($_FILES['uploadimg1']['temp_name'],'newsimage'.$newfilename);
                move_uploaded_file($_FILES['uploadimg2']['temp_name'],'newsimage'.$newfilename2);

            }
        }      
       
            
        }
       
}
