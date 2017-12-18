<html>
<?php $title = 'Register'; ?>
<?php $currentPage = 'register'; ?>
<?php include('head.php'); ?>

<body>
    <?php include('navbar.php'); ?>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-3 cen">
            <h2>Registracija</h2>
            <form action="/action_page.php">
                <div class="form-group mar-top-2rem">
                    <input type="email" class="form-control" id="email" placeholder="Uporabniško ime" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" placeholder="Geslo" name="pwd">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd2" placeholder="Ponovno vpišite geslo" name="pwd2">
                </div>
                <button type="submit" class="btn btn-default">Registracija</button>
            </form>
        </div>
    </div>

</body>
</html>