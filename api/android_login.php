<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 15/01/2018
 * Time: 00:56
 */

require_once 'dbconn.php';

$jsonEncoded = file_get_contents('php://input');
$jsonDecoded = json_decode($jsonEncoded, true);

if (is_array($jsonDecoded)) {

    $email = mysqli_real_escape_string($conn, $jsonDecoded["email"]);
    $password = mysqli_real_escape_string($conn, $jsonDecoded["password"]);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            echo json_encode([
                "status" => "success",
                "message" => "uspešna prijava",
                "session_id" => intval($row["id"])
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Napačno uporabniško ime ali geslo"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Napačno uporabniško ime ali geslo"
        ]);
    }
} else {
echo json_encode([
    "status" => "error",
    "message" => "no data"
]);
}
