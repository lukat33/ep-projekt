<html>
<?php
$title = 'Admin';
$currentPage = 'adminpanel';
$page_type = 'private';
include('head.php');
?>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-3" id="admin-title">
            <h2>Admin</h2>
        </div>
    </div>
    <div class="row  mar-top-2rem">
        <div class="col-sm-3"></div>
        <div class="col-sm-4">
            <table class="table" id="admin_table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th>Ime</th>
                    <th>Priimek</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php include('../api/admin_api.php'); ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_add">Dodaj</button>
        </div>
    </div>
    <!--    my modal-->
    <?php
        include_once('modal_edit.php');
        include_once('modal_add.php');
    ?>
</div>

</body>
</html>