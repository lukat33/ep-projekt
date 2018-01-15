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
    $result = mysqli_query($conn, "SELECT *
                                           FROM users
                                           INNER JOIN contact_data cd ON users.id = cd.user_id
                                           WHERE user.id=". $user_id);
    echo json_encode(mysqli_fetch_array($result));
}