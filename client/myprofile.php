<html>
<?php
    $title = 'Moj profil';
    $currentPage = 'myprofile';
    $page_type = 'private';
    include('head.php');
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
        <form class="" action="login.php" method="POST">
            <div class="row mar-top-2rem">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Ime</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="Ime"">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Priimek</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Priimek"">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="test@gmail.com"">
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
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Naslov</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="street" class="form-control" placeholder="Zgornje Grušovlje"">
                    </div>
                </div>
                <div class="col-sm-1">
                    <input type="text" name="street_number" class="form-control" placeholder="32"">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Kraj in poštna številka</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="city" class="form-control" placeholder="Šempeter"">
                    </div>
                </div>
                <div class="col-sm-1">
                    <input type="text" name="postal_code" class="form-control" placeholder="3311"">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <label class="col-sm-2 col-form-label">Telefon</label>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" value="040357173">
                    </div>
                    <button type="submit" name="save" class="btn btn-default">Shrani</button>
                </div>

            </div>
        </form>
    </div>
</body>
</html>