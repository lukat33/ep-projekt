<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 11:14
 */

$title = 'Izdelek';
$currentPage = 'index';
$page_type = 'public';
include('head.php');
include_once('../api/logout_api.php');
?>

<head>
    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>
    <script src="js/article.js"></script>
</head>

<html>
    <body>
        <?php include('navbar.php'); ?>
        <div class="container">
           <?php include('../api/article_api.php'); ?>
        </div>
    </body>
</html>
