<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 15/01/2018
 * Time: 06:12
 */

include_once 'dbconn.php';

if (isset($_GET["id"])) {
    $user_id = mysqli_real_escape_string($_GET["id"]);
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=". $user_id);
    $orders = [];

    while($row = mysqli_fetch_array($result)) {
        $orders[] = $row;
    }

    echo json_encode($orders);
}