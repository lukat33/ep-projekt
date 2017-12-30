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
                    </thead>
                        <tbody>
                            <?php include('../api/basket_api.php'); ?>
                        </tbody>
                    <tfoot>
                        <tr>
                            <td><a href="index.php" class="btn tfn-warning"><i class="fa fa-angle-left"></i> Nadaljujte z nakupovanjem</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Skupaj $1.99</strong></td>
                            <td><a href="#" class="btn btn-success btn-block">Naprej <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </body>
</html>
