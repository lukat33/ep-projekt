<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 11:24
 */

require_once 'dbconn.php';

if (isset($_POST["action"])) {
    session_start();
    if ($_POST["action"] == "rate") {
        $rating = $id = mysqli_real_escape_string($conn, $_POST['rating']);
        $article_id = $id = mysqli_real_escape_string($conn, $_POST['articleId']);
        $user_id = $_SESSION["u_id"];

        $query = "SELECT * FROM ratings WHERE article_id=". $article_id ." AND user_id=". $user_id;
        $result = mysqli_query($conn, $query);

        $rows = array();
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }

        if (sizeof($rows) == 0) {
            $query = "INSERT INTO ratings VALUES(NULL, ". $article_id .", ". $user_id .", ". $rating .")";
        } else {
            $query = "UPDATE ratings SET rating=". $rating ." WHERE article_id=". $article_id ." AND user_id=". $user_id ;
        }

        mysqli_query($conn, $query);
    }
} elseif (isset($_GET["id"]))
{
    $id = (int) mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM article WHERE id='$id'";
    $articles = mysqli_query($conn, $query);
    $rating = getRating($id, $conn);

    echo '<div class="row top-buffer">';
    $i = 0;
    while ($row = mysqli_fetch_array($articles)) {
        $images = get_images($conn, $row["id"]);

        if ((int)$row["activated"] == 1) {
            echo '<div class="py-5">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="images/' . $row["picture"] . '" class="article-img primary">
                        </div>
                        <div class="col-md-8">
                          <h1 class="">' . $row["name"] . '</h1>';
            if (isset($_SESSION['u_id']) && ($_SESSION['u_role'] == "customer" || $_SESSION['u_role'] == "admin" || $_SESSION['u_role'] == "salesman")) {
                echo '<div class="rating" id="' . $rating . '" data-article="' . $row["id"] . '">
                              </div>';
            }
            echo '<p>' . $row["description"] . '</p>
                          <span><b>Cena: ' . $row["price"] . '€</b></span>
                          <hr>
                          <button onclick="addToBasketAction(' . $row["id"] . ')" type="button" class="btn btn-default">Dodaj v košarico</button>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-1">
                        <img src="images/' . $row["picture"] . '" class="article-img thumb" id=-1>
                      </div>';
            for ($i = 0; $i < sizeof($images); $i++) {
                echo        '<div class="col-md-1">
                          <img src="images/' . $images[$i]["picture"] . '" class="article-img thumb" id='. $i .'>
                        </div>';
            }
            echo      "</div>
                    </div>
                  </div>
                </div>";
        } else {
            header("Location: ../client/error404.php");
        }
    }
}
else
{
    header("Location: ../client/error404.php");
}

function get_images($conn, $article_id) {
    $query = "SELECT picture FROM article_pictures WHERE article_id=". $article_id;
    $result = mysqli_query($conn, $query);
    $images = [];

    while ($image = mysqli_fetch_array($result)) {
        $images[] = $image;
    }

    return $images;
}

function getRating($article_id, $conn) {
    $query = "SELECT rating FROM ratings WHERE article_id=". $article_id;
    $result = mysqli_query($conn, $query);
    $sum = 0;
    $size = 0;

    while($row = mysqli_fetch_array($result))
    {
        $sum += $row["rating"];
        $size++;
    }

    if ($size == 0) return 0;
    return round($sum/$size, 2);
}