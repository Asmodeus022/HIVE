<?php
    session_start();
    @include "./cross_access.php";
    @include "../includes/database.php";
    @include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="row p-0 m-0" style="height: 100vh; overflow: hidden">
        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row p-3 h-100">
                <h3 class=" mb-4">Inventory</h3>
            </div>
        </div>
    </div>
</body>
</html>