<html>
<?php
    $title = 'Domov';
    $currentPage = 'index';
    $page_type = 'public';
    include('head.php');
    include_once('../api/logout_api.php');

    if (!isset($_GET["view"])) {
        header('Location: '. "index.php?view=received");
    }
?>

<head>
    <script type="text/javascript" src="js/basket.js" ></script>
    <script type="text/javascript" src="js/index.js" ></script>
</head>
    <?php
        if ($_SESSION['u_role'] == "salesman"){
            include("salesman_index.php");
        } else {
            include("client_index.php");
        }
    ?>
</html>