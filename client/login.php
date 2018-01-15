<html>
<?php
    $title = 'Prijava';
    $currentPage = 'login';
    $page_type = 'public';
    include('head.php');
    include('../api/login_api.php');
?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-3" id="login-title">
                <h2>Prijava</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-3 login-form">
                <form class="" action="login.php" method="POST">
                    <div class="form-group mar-top-2rem">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Geslo" value="<?php echo $password; ?>" >
                    </div>
                    <button type="submit" name="login" class="btn btn-default" id="login-btn">Prijava</button>
                    <!-- Validation errors -->
                    <?php include('errors.php'); ?>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-4" style="margin-top:2rem">
                <a style="text-align: center;" href="login_employee.php">Prijava za osebje ></a>
            </div>
        </div>
    </div>
</body>
</html>