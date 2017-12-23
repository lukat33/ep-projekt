<html>
<?php $title = 'Prijava'; ?>
<?php $currentPage = 'login'; ?>
<?php include('head.php'); ?>

<body>
    <?php include('navbar.php'); ?>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-3 cen">
            <h2>Prijava</h2>
            <form action="/action_page.php">
                <div class="form-group mar-top-2rem">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" >
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Geslo" >
                </div>
                <button type="submit" class="btn btn-default">Prijava</button>
            </form>
        </div>
    </div>
</body>
</html>