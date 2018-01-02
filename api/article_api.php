<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 11:24
 */

require_once 'dbconn.php';


if (isset($_GET["id"]))
{
    $id = (int) mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM article WHERE id='$id'";
    $articles = mysqli_query($conn, $query);

    echo '<div class="row top-buffer">';
    $i = 0;
    while ($row = mysqli_fetch_array($articles))
    {
        echo '<div class="py-5">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="images/'. $row["picture"] .'" class="article-img">
                    </div>
                    <div class="col-md-8">
                      <h1 class="">'. $row["name"] .'</h1>
                      <p>'. $row["description"] .'</p>
                      <span><b>Cena: '. $row["price"] .'€</b></span>
                      <hr>
                      <button onclick="addToBasketAction('. $row["id"] .')" type="button" class="btn btn-default">Dodaj v košarico</button>
                    </div>
                  </div>
                </div>
              </div>';
    }
    echo "</div>";
}
else
{
    header("Location: ../client/error404.php");
}
