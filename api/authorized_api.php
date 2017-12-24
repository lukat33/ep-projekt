<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 24-Dec-17
 * Time: 21:34
 */
// Check if anonymous user is trying to access private page
if(!(isset($_SESSION['u_id']))) {
    if ($page_type == "private") {
        header("Location: index.php");
        exit();
    }
} else {
    // User logged in and trying to access register or login pages
    if ($currentPage == "register" || $currentPage == "login") {
        header("Location: index.php");
        exit();
    }
}