<html>
<?php
    $title = 'Košarica';
    $currentPage = 'basket';
    $page_type = 'private';
    include('head.php');
    include_once('../api/logout_api.php');
?>

    <head>
        <link rel="stylesheet" type="text/css" href="css/basket.css">
        <script type="text/javascript" src="js/basket.js" ></script>
    </head>

    <body>
        <?php include('navbar.php'); ?>

        <div class="container">
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:100%">Izdelek</th>
                            <th style="width:10%">Cena</th>
                            <th style="width:8%">Količina</th>
                            <th style="width:22%" class="text-center">Skupna cena</th>
                            <th style="width:10%"></th>
                        </tr>
                    <?php include('../api/basket_api.php'); ?>
                </table>
            </div>
        </div>
    </body>
</html>
