<html>
<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 11:14
 */
$title = 'Domov';
$currentPage = 'index';
$page_type = 'public';
include('head.php');
include_once('../api/logout_api.php');
?>

    <body>
        <?php include('navbar.php'); ?>

        <div class="container">
           <?php include('../api/article_api.php'); ?>
        </div>
    </body>
</html>
