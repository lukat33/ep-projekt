<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 03/01/2018
 * Time: 15:58
 */

$title = 'Pregled naročila';
$currentPage = 'order_preview';
$page_type = 'private';
include('head.php');
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/order_preview.js" ></script>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h3><p>Pregled vašega naročila</p></h3>
        </div>
    </div>
    <div class="row mar-top-1rem">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <table class="table" id="salesman_table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th>Slika</th>
                    <th>Ime artikla</th>
                    <th>Cena</th>
                    <th>Količina</th>
                    <th>Davek</th>
                    <th>Skupna cena</th>
                </tr>
                </thead>
                <tbody>
                <?php include('../api/order_preview_api.php'); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>