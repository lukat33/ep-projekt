
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php">Trgovina</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($currentPage == "index") echo "active"; else echo ""; ?>">
                <a class="nav-link" href="index.php">Domov <span class="sr-only">(current)</span></a>
            </li>

            <?php
                if (isset($_SESSION['u_id'])) {
                    if ($currentPage == "myprofile") $active = "active"; else $active = "";
                    echo
                        '<li class="nav-item '.$active.'">
                            <a class="nav-link" href="myprofile.php">Moj profil</a>
                         </li>';
                    if ($_SESSION['u_role'] == "admin") {
                        if ($currentPage == "adminpanel") $active = "active"; else $active = "";
                        echo
                        '<li class="nav-item '.$active.'">
                            <a class="nav-link" href="adminpanel.php">Admin</a>
                         </li>';
                    }
                }
            ?>
        </ul>
        <?php
            // If user is logged in
            if (isset($_SESSION['u_id'])) {
                echo '<a href="index.php?logout" class="btn btn-login btn-warning" role="button">Odjava</a>';
            } else {
                // No user is logged in
                echo
                    '<a href="login.php" class="btn btn-login btn-primary" role="button">Prijava</a>
                     <a href="register.php" class="btn btn-login btn-info" role="button">Registracija</a>';
            }
        ?>
    </div>
</nav>