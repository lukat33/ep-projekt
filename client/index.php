<html>
<?php
    $title = 'Domov';
    $currentPage = 'index';
    $page_type = 'public';
    include('head.php');
    include_once('../api/logout_api.php');
?>

<head>
    <script type="text/javascript" src="js/basket.js" ></script>
</head>


<body>

    <?php include('navbar.php'); ?>

    <div class="container">
        <div class="h2" style="text-align: center">Izdelki na voljo v trgovini</div>
        <hr>
        <?php include('../api/index_api.php'); ?>
    </div><!-- /.container -->
</body>
</html>