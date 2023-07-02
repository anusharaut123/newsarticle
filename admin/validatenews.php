<?php
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['newssubmit'])){
        $category=$_POST['category'];
        $authorname=$_POST['author'];
        $title=$_POST['title'];
        $shortdescription=$_POST['shortdescription'];
        $description=$_POST['description'];

        $tempimage1 = explode(".", $_FILES["image1"]["name"]);
        $newfilename = uniqid().".".end($tempimage1);
        $fileType = end($tempimage1);
        $allowTypes = array('jpg','png','jpeg');

        $tempimage2 = explode(".", $_FILES["image2"]["name"]);
        $newfilename2 = uniqid().".".end($tempimage2);
        $fileType2 = end($tempimage2);
        $allowTypes2 = array('jpg','png','jpeg');

        if(in_array($fileType,$allowTypes) && in_array($fileType2,$allowTypes2)){
            $query="INSERT INTO news (category, authorname, title, shortdescription, uploadimg1, description, uploadimg2) VALUES('$category', '$authorname', '$title', '$shortdescription', '$newfilename', '$description', '$newfilename2')";
            if(mysqli_query($conn, $query)){
                move_uploaded_file($_FILES["image1"]["tmp_name"],'newsimage/'.$newfilename);
                move_uploaded_file($_FILES["image2"]["tmp_name"],'newsimage/'.$newfilename2);

            }
        }          
    }  
}
