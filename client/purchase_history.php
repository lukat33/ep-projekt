<html>
<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 10/01/2018
 * Time: 12:28
 */

$title = 'Moji nakupi';
    $currentPage = 'purchase_history';
    $page_type = 'private';
    include('head.php');
    include_once('../api/logout_api.php');
?>


    <body>
        <?php include('navbar.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6" id="salesman-title">
                    <h2>Moja naročila</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6">
                    <p>Pregled vseh vaših naročil</p>
                </div>
            </div>
            <div class="row mar-top-1rem">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table class="table" id="salesman_table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th>Artikli</th>
                            <th>Datum naročila</th>
                            <th>Status</th>
                            <th>Cena</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php include('../api/purchase_history_api.php'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container -->
    </body>
</html>