<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 29-Dec-17
 * Time: 19:04
 */
    $title = 'Napaka';
    $currentPage = 'error404';
    $page_type = 'public';
    include('head.php');
?>
<html>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="starter-template">
            <h1>Napaka 404</h1>
            <p class="lead">Ups, nekaj je šlo narobe.<br></p>
            <?php echo $napaka; ?>
        </div>
    </div>
</body>
</html>