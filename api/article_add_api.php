<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 13:19
 */
include_once 'dbconn.php';
$name = "";
$price = "";
$description = "";
$errors = array();
$uploadOk = 1;
$imageName = "none.png";
$article_add_succes = "";

if (isset($_POST['article_add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if (!empty(basename($_FILES["fileToUpload"]["name"]))) {
        $imageName = basename($_FILES["fileToUpload"]["name"]);
    }

    // Ensure that form fields are filled properply
    if (empty($name) || empty($price) || empty($description )) {
        array_push($errors, "Izpolni vsa vnosna polja");
    } else {
        $price =  floatval($price);

        if ($imageName != "none.png") {
            $target_file = "../client/images/" . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Image info array
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                // File is not an image
                array_push($errors, "Datoteka ni slika");
                $uploadOk = 0;
            }

            // Check if file is smaller than 500KB
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                array_push($errors, "Datoteka je prevelika");
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                } else {
                    array_push($errors, "Prišlo je do napake, poskusi ponovno kasneje");
                    $article_add_succes = "";
                }
            }
        }
    }

//    // No errors
    if (count($errors) == 0) {
        // Check if user already exists in database
        $query = "INSERT INTO article (name, picture, price, description, activated)
                      VALUES ('$name', '$imageName', '$price', '$description', '1')";
        mysqli_query($conn, $query);

        $article_add_succes =
            '<div class="alert alert-success mar-top-2rem" style="text-align: center">
                Artikel je bil dodan!
             </div>';

        $name = $price = $description = "";
    }
    unset($_POST);
}