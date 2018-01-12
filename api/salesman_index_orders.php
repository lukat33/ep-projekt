<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 12/01/2018
 * Time: 10:10
 */

include_once 'dbconn.php';


if (isset($_GET["view"])) {
    if ($_GET["view"] == "received") {
        $status = "oddano";
    } elseif ($_GET["view"] == "confirmed") {
        $status = "potrjeno";
    } elseif ($_GET["view"] == "canceled") {
        $status = "preklicano";
    }

    $query = "SELECT orders.id, orders.date, users.firstname, users.lastname
              FROM orders
              INNER JOIN users ON users.id=orders.user_id
              WHERE status='". $status ."'";
    $result = mysqli_query($conn, $query);
    $count = 1;

    while ($row = mysqli_fetch_array($result)) {
        $articles = get_order_articles($conn, $row["id"]);
        $date=date_create($row["date"]);

        echo '<tr id="' . $count . '">
        <th scope="row"> ' . $count . ' </th>
        <td> ' . $row["firstname"] . " " . $row["lastname"] . ' </td>
        <td> ' . $articles["articles"] . ' </td>
        <td> ' . date_format($date,"d.m.Y H:i:s") . ' </td>
        <td> ' . $articles['total'] . '€</td>';
        if ($_GET["view"] == "received") {
            echo '<td> <button onclick="updateOrder('. $row["id"] .', \'confirm\')" class="btn btn-success btn-sm">Potrdi</button></td>';
        }
        if ($_GET["view"] == "received" || $_GET["view"] == "confirmed") {
            echo ' <td> <button onclick="updateOrder('. $row["id"] .', \'cancel\')" class="btn btn-danger btn-sm">Prekliči</button></td>';
        }
        echo '</tr>';
        $count++;
    }
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