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
$images = ["", "", ""];
$izbris = "off";

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
    $query = "SELECT picture from article_pictures WHERE article_id='$id'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $images[$i] = "images/" . $row['picture'];
            $i++;
        }
    }
} elseif(isset($_POST['article_save'])) {
    $id = cleanData(mysqli_real_escape_string($conn, $_POST['id']));
    $name = cleanData(mysqli_real_escape_string($conn, $_POST['name']));
    $price = cleanData(mysqli_real_escape_string($conn, $_POST['price']));
    $description = cleanData(mysqli_real_escape_string($conn, $_POST['description']));
    if (!empty($_POST['togglebtn'])) {
        $status = cleanData(mysqli_real_escape_string($conn, $_POST['togglebtn']));
    }
    if (!empty($_POST['izbrisiSlike'])) {
        $izbris = cleanData(mysqli_real_escape_string($conn, $_POST['izbrisiSlike']));
    }

    if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']["name"][0])) {
        $myFile = $_FILES['fileToUpload'];
        $fileCount = count($myFile["name"]);
        if ($fileCount > 0 && $myFile["name"] != "") {
            $imageName = $myFile["name"][0];
        }
    }

    // Ensure that form fields are filled properply
    if (empty($name) || empty($price) || empty($description )) {
        array_push($errors, "Izpolni vsa vnosna polja");
    } else {
        $price =  floatval($price);

        if ($imageName != "none.png") {
            for ($i=0; $i<$fileCount; $i++) {
                $target_file = "../client/images/" . basename($_FILES["fileToUpload"]["name"][$i]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Image info array
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    // File is not an image
                    array_push($errors, "Datoteka ni slika");
                    $uploadOk = 0;
                }

                // Check if file is smaller than 500KB
                if ($_FILES["fileToUpload"]["size"][$i] > 5000000) {
                    array_push($errors, "Datoteka je prevelika");
                    $uploadOk = 0;
                }

//                if (file_exists($target_file)) {
//                    $uploadOk = 2;
//                }

                if ($uploadOk == 1 && !file_exists($target_file)) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {

                    } else {
                        array_push($errors, "Prišlo je do napake, poskusi ponovno kasneje");
                    }
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

//        if ($uploadOk == 2) {
//            $query = "SELECT picture FROM article_pictures WHERE article_id='$id'";
//            $result = mysqli_query($conn, $query);
//            while ($row = mysqli_fetch_assoc($result)['picture']) {
//                if ($row != "none.png")
//                    unlink('images/' . $row);
//            }
//            $uploadOk = 1;
//        }
        $pic = "";
        echo $izbris;
        if ($izbris == "on") {
            $query = "DELETE FROM article_pictures WHERE article_id='$id'";
            mysqli_query($conn, $query);
            $imageName = "none.png";
            $pic = "picture='none.png',";
        }

        if ($uploadOk == 1) {
            $pic = "picture='$imageName',";

            if ($izbris != "on") {
                $query = "DELETE FROM article_pictures WHERE article_id='$id'";
                mysqli_query($conn, $query);

                if ($fileCount > 1) {
                    for ($i=1; $i<$fileCount; $i++) {
                        $imName = $_FILES["fileToUpload"]["name"][$i];
                        $query = "INSERT INTO article_pictures (article_id, picture)
                      VALUES ('$id', '$imName')";
                        mysqli_query($conn, $query);
                    }
                }
            }
        }

        $query = "UPDATE article
                  SET name='$name', $pic price='$price', description='$description', activated='$status'
                  WHERE id =$id";
        mysqli_query($conn, $query);
        $query = "SELECT picture FROM article WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $imageName = mysqli_fetch_assoc($result)['picture'];
        $izbris = "off";
        header("Location: article_edit.php?id=".$id);
    }
    unset($_POST);
}
else {
    header("Location: ../client/error404.php");
}