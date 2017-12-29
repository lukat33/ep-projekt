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
        <?php include('../api/index_api.php'); ?>
    </div><!-- /.container -->
</body>
</html>