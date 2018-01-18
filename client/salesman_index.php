<body>

    <?php include('navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-6">
                <h2>Naročila</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-6">
                <div class="btn-group">
                    <?php include("../api/salesman_index_buttons.php") ?>
                </div>
            </div>
        </div>
        <div class="row mar-top-1rem">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th>Stranka</th>
                        <th>Artikli</th>
                        <th>Datum</th>
                        <th>Cena</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php include('../api/salesman_index_orders.php'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container -->
</body>