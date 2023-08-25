<?php
require_once "../db/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['newssubmit'])) {
        $category = $_POST['category'];
        $authorname = $_POST['author'];
        $title = $_POST['title'];
        $shortdescription = $_POST['shortdescription'];
        $description = $_POST['description'];
        $images = $_FILES['images'];

        // Validate Author Name
        if (!preg_match("/^[a-zA-Z\s]+$/", $authorname)) {
          $authorerror="Author name should contain only characters.";
        }

        // Validate Title (only letters and numbers)
        if (!preg_match("/^[a-zA-Z0-9\s]+$/", $title)) {
            $titleerror= "Title should contain only letters and numbers.<br>";
        }

        // Validate Short Description and Description
        if (empty($shortdescription)) {
            $shortdescriptionerror= "Short description is required.<br>";
        }
        if (empty($description)) {
            $descriptionerror= "Description is required.<br>";
        }

        // Validate Images (at least 3)
        if (count($images['tmp_name']) < 3) {
            $imageerror= "Please upload at least 3 images.<br>";
        }

        if (count($images['tmp_name']) >= 3 && preg_match("/^[a-zA-Z\s]+$/", $authorname) && preg_match("/^[a-zA-Z0-9\s]+$/", $title) && !empty($shortdescription) && !empty($description)) {
            $query = "INSERT INTO news (category, authorname, title, introduction, description) VALUES('$category', '$authorname', '$title', '$shortdescription', '$description')";
            if (mysqli_query($conn, $query)) {
                $newId = mysqli_insert_id($conn);
                echo $newId;
                $allowTypes = array('jpg', 'png', 'jpeg');
                $targetDirectory = "newsimage/";

                foreach ($images['tmp_name'] as $key => $tmpName) {
                    $extension = pathinfo($images['name'][$key], PATHINFO_EXTENSION);
                    $uniqueFilename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                    $targetFile = $targetDirectory . $uniqueFilename;

                    if (in_array($extension, $allowTypes)) {
                        if (move_uploaded_file($tmpName, $targetFile)) {
                            $query = "INSERT INTO news_image (newsid, imagename) VALUES('$newId', '$uniqueFilename')";
                            if (mysqli_query($conn, $query)) {
                                echo "<script>alert('News Added Successfully.')</script>";
                            }else{
                                echo "<script>alert('News Added Failed.')</script>";
                            }
                        } else {
                            echo "<script>alert('Image Upload Failed.')</script>";
                        }
                    }
                }
            }
        }
    }
}
?>
