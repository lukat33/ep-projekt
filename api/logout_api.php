<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 24-Dec-17
 * Time: 17:55
 */
// Log out
if (isset($_GET['logout'])) {
    logout();
    exit();
}

function logout() {
    $role = $_SESSION['u_role'];
    session_unset();
    session_destroy();
    if ($role == "customer")
        header("Location: ../client/login.php");
    else
        header("Location: ../client/login_employee.php");
    exit();
}