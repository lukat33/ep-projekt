<?php
    ob_start();
    session_start();
    include_once("../api/authorized_api.php");
?>
<head>
    <meta charset="utf-8">
    <title><?php echo($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>