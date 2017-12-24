<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 24-Dec-17
 * Time: 17:55
 */
// Log out
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../client/login.php");
    exit();
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: ../client/login.php");
    exit();
}