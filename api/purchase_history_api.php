<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 10/01/2018
 * Time: 12:37
 */

// Connect to the database
include_once 'dbconn.php';

$query = "SELECT * FROM orders WHERE user_id=". $_SESSION["u_id"];
$result = mysqli_query($conn, $query);
$count = 1;

while ($row = mysqli_fetch_array($result)) {
    $articles = get_order_articles($conn, $row["id"]);
    $date=date_create($row["date"]);

    echo '<tr id="' . $count . '">
        <th scope="row"> ' . $count . ' </th>
        <td> ' . $articles["articles"] . ' </td>
        <td> ' . date_format($date,"d.m.Y H:i:s") . ' </td>
        <td> ' . $row['status'] . ' </td>
        <td> ' . $articles['total'] . '€</td>
    </tr>';
    $count++;
}

function get_order_articles($conn, $order_id) {
    $query = "SELECT article.name, order_article.quantity, article.price
              FROM order_article
              INNER JOIN article ON article.id = order_article.article_id
              WHERE order_article.order_id=" . $order_id;
    $result = mysqli_query($conn, $query);
    $articles = "";
    $total = 0;

    $article = mysqli_fetch_array($result);
    $articles = $articles . $article["name"];
    $total += $article["quantity"] * $article["price"];
    while ($article = mysqli_fetch_array($result)) {
        $articles = $articles . ", ";
        $articles = $articles . $article["name"];
        $total += $article["quantity"] * $article["price"];
    }

    $res["articles"] = $articles;
    $res["total"] = $total;

    return $res;
}