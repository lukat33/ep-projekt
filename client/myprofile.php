<html>
<?php
    $title = 'Moj profil';
    $currentPage = 'myprofile';
    $page_type = 'private';
    include('head.php');
    include('../api/myprofile_api.php');
?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-3" id="profile-title">
                <h2>Moj profil</h2>
            </div>
        </div>
        <form class="" method="POST">
            <div class="row mar-top-2rem">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Ime</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" value="<?php echo $_SESSION['u_firstname']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Priimek</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" value="<?php echo $_SESSION['u_lastname']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['u_email']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Novo geslo</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="password" name="password_1" class="form-control"">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Potrdi geslo</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="password" name="password_2" class="form-control" ">
                    </div>
                    <?php if ($_SESSION['u_role'] != "customer"): ?>
                        <button type="submit" name="update" class="btn btn-default">Shrani</button>
                        <!-- Validation errors -->
                        <?php include('errors.php'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($_SESSION['u_role'] == "customer"): ?>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <label class="col-sm-2 col-form-label">Naslov</label>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" name="street" class="form-control" value="<?php echo $_SESSION['u_street']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <input type="text" name="street_number" class="form-control" value="<?php echo $_SESSION['u_street_number']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <label class="col-sm-2 col-form-label">Kraj in poštna številka</label>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" name="city" class="form-control" value="<?php echo $_SESSION['u_city']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <input type="text" name="postal_code" class="form-control" value="<?php echo $_SESSION['u_postal_code']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <label class="col-sm-2 col-form-label">Telefon</label>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" value="<?php echo $_SESSION['u_phone']; ?>">
                        </div>
                        <button type="submit" name="update" class="btn btn-default">Shrani</button>
                        <!-- Validation errors -->
                        <?php include('errors.php'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>