<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 18:52
 */
include_once 'dbconn.php';
$name = "";
$price = "";
$description = "";
$errors = array();
$uploadOk = 1;
$status = "";
$imageName = "none.png";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM article WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $price = $row['price'];
    $description = $row['description'];
    $imageName = $row['picture'];
    if ($row['activated'] == "1")
        $status = "checked";

} elseif(isset($_POST['article_save'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if (!empty($_POST['togglebtn'])) {
        $status = mysqli_real_escape_string($conn, $_POST['togglebtn']);
    }

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
            if ($check !== false) {
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

            if (file_exists($target_file)) {
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                } else {
                    array_push($errors, "Prišlo je do napake, poskusi ponovno kasneje");
                }
            }
        } else {
            $uploadOk = 0;
        }
    }

    // No errors
    if (count($errors) == 0) {
        if ($status == "on")
            $status = 1;
        else
            $status = 0;

        $pic = "";
        if ($uploadOk == 1) $pic = "picture='$imageName',";
        echo $status;
        $query = "UPDATE article
                  SET name='$name', $pic price='$price', description='$description', activated='$status'
                  WHERE id = $id";

        mysqli_query($conn, $query);

        $query = "SELECT picture FROM article WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $imageName = mysqli_fetch_assoc($result)['picture'];
        header("Location: article_edit.php?id=".$id);
    }
    unset($_POST);
}
else {
    header("Location: ../client/error404.php");
}