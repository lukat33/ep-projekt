<html>
<?php
$title = 'Domov';
$currentPage = 'index';
$page_type = 'public';
include('head.php');
include_once('../api/logout_api.php');
?>

    <body>
        <?php include('navbar.php'); ?>

        <div class="container">
            <?php include('../api/basket_api.php'); ?>
        </div>
    </body>
</html>
