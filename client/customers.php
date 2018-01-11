<html>
<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 11/01/2018
 * Time: 21:10
 */


$title = 'Stranke';
    $currentPage = 'customers';
    $page_type = 'private';
    include('head.php');
    include_once('../api/logout_api.php');
?>
    <head>
        <script type="text/javascript" src="js/customers.js" ></script>
    </head>


    <body>
        <?php include('navbar.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6" id="salesman-title">
                    <h2>Stranke</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6">
                    <p>Aktivacija in deaktivacija računov strank</p>
                </div>
            </div>
            <div class="row mar-top-1rem">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table class="table" id="salesman_table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th>Ime</th>
                            <th>Priimek</th>
                            <th>Email</th>
                            <th>Aktivirana</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php include('../api/customers_api.php'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container -->
    </body>
</html>