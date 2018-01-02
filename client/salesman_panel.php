<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 17:05
 */
$title = 'Prodajalec';
$currentPage = 'salesman_panel';
$page_type = 'private';
include('head.php');
?>
<html>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-3" id="salesman-title">
            <h2>Prodajalec</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-6">
            <p>Pregled vseh artiklov v trgovini.</p>
        </div>
    </div>
    <div class="row mar-top-1rem">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <table class="table" id="salesman_table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th>Ime artikla</th>
                    <th>Slika</th>
                    <th>Cena</th>
                    <th>Opis</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php include('../api/salesman_panel_api.php'); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>