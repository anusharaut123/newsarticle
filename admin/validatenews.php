<?php
require_once "../db/connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['newssubmit'])){
        $category=$_POST['category'];
        $authorname=$_POST['author'];
        $title=$_POST['title'];
        $shortdescription=$_POST['shortdescription'];
        $description=$_POST['description'];

        $query="INSERT INTO news (category, authorname, title, introduction, description) VALUES('$category', '$authorname', '$title', '$shortdescription', '$description')";
        if(mysqli_query($conn, $query)){
            echo "News Added successfully";
            $newId = mysqli_insert_id($conn);
            echo $newId;
            $allowTypes = array('jpg','png','jpeg');
            $targetDirectory = "newsimage/";

            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
                $uniqueFilename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                $targetFile = $targetDirectory . $uniqueFilename;

                if(in_array($extension, $allowTypes)){
                    if (move_uploaded_file($tmpName, $targetFile) && in_array($extension, $allowTypes)) {
                        echo 'Image uploaded successfully: ' . $targetFile . '<br>';
                        $query="INSERT INTO news_image (newsid, imagename) VALUES('$newId', '$uniqueFilename')";
                        if(mysqli_query($conn, $query)){
                            echo "image inserted";
                        }

                    } else {
                        echo 'Image upload failed: ' . $_FILES['images']['name'][$key] . '<br>';
                    }
                }
            }
        }
     
    }  
}
