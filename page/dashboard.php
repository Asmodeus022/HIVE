<?php
    session_start();
    @include "./cross_access.php";
    @include "../includes/database.php";
    @include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="d-flex p-0 m-0" style="height: 100vh">
        <div class="col-1 p-0 m-0 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col p-0 m-0">
            <div class="row">

            </div>
        </div>
    </div>
</body>
</html>