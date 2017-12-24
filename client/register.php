<html>
<?php
    $title = 'Register';
    $currentPage = 'register';
    $registerSuccess = "";
    $page_type = 'public';
    include('head.php');
    include('../api/register_api.php');
?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3" id="register-title"><h2>Registracija</h2></div>
        </div>

        <form action="register.php" method="POST">
            <div class="row mar-top-2rem">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Ime" value="<?php echo $firstname; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Priimek" value="<?php echo $lastname; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="password" name="password_1" id="password_1" class="form-control" placeholder="Geslo" value="<?php echo $password_1; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="password" name="password_2" id="password_2" class="form-control" placeholder="Potrdi geslo" value="<?php echo $password_2; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" name="street" id="street" class="form-control" placeholder="Ulica" value="<?php echo $street; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="text" name="street_number" id="street_number" class="form-control" placeholder="Hišna številka" value="<?php echo $street_number; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="city" id="city" class="form-control" placeholder="Mesto" value="<?php echo $city; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Poštna številka" value="<?php echo $postal_code; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Telefonska številka" value="<?php echo $phone; ?>">
                    </div>
                    <button type="submit" name="register" class="btn btn-default" id="register-btn">Registracija</button>
                    <!-- Validation errors -->
                    <?php
                        include('errors.php');
                        echo $registerSuccess;
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>