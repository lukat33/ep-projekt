<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 23-Dec-17
 * Time: 14:41
 */
// establish database connection
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ep";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);