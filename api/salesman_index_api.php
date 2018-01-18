<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 12/01/2018
 * Time: 10:59
 */

include_once 'dbconn.php';


if (isset($_POST["action"])) {
    if ($_POST["action"] == "confirm") {
        $order_id = cleanData(mysqli_real_escape_string($conn, $_POST["order_id"]));
        $query = "UPDATE orders SET status='potrjeno' WHERE id=". $order_id;
        mysqli_query($conn, $query);
    }

    if ($_POST["action"] == "cancel") {
        $order_id = cleanData(mysqli_real_escape_string($conn, $_POST["order_id"]));
        $query = "UPDATE orders SET status='preklicano' WHERE id=". $order_id;
        mysqli_query($conn, $query);
    }
}