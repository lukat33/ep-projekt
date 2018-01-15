<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 14/01/2018
 * Time: 23:17
 */


require_once 'dbconn.php';

if (isset($_GET)) {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);
        $query = "SELECT * FROM article WHERE activated=1 AND id=". $id;
        $result = mysqli_query($conn, $query);

        echo json_encode(mysqli_fetch_array($result));

    } else {
        $query = "SELECT * FROM article WHERE activated=1";
        $result = mysqli_query($conn, $query);
        $articles = [];

        while ($row = mysqli_fetch_array($result)) {
            $articles[] = $row;
        }

        echo json_encode($articles);
    }
}
