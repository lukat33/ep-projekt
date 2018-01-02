<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 28/12/2017
 * Time: 19:05
 */

require_once 'dbconn.php';

$query = "SELECT * FROM article";
$articles = mysqli_query($conn, $query);

echo '<div class="row top-buffer">';
$i = 0;
while ($row = mysqli_fetch_array($articles))
{
    $row["description"] = limit_description_length($row["description"], 130);

    $i++;
    if ($i % 4 == 0)
    {
        echo '</div><div class="row top-buffer">';
    }
    echo '<div class="col-md-4">
            <div class="article">
                <div class="row">
                    <div class="col-md-12">
                        <a href="article.php?id='. $row["id"] .'"><h3>'. $row["name"] .'</h3></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/'. $row["picture"] .'" class="article-img">
                    </div>
                    <div class="col-md-6">
                        <p>'. $row["description"] .'</p>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12">
                        <span style="margin-top: 15px; display: inline-block"><b>Cena: '. $row["price"] .'€</b></span>
                        <button style="float: right" onclick="addToBasketAction('. $row["id"] .')" type="button" class="btn btn-default">Dodaj v košarico</button>
                    </div>
                </div>
            </div>
          </div>';
}
echo "</div>";

function limit_description_length($description, $length)
{
    if (strlen($description) > $length) {
        $description = substr($description, 0, $length);
        $description = $description . "...";
    }

    return $description;
}
