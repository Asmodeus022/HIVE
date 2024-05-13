<?php
    session_start();
    @include "../includes/database.php";

    $ownerId = mysqli_real_escape_string($conn, $_SESSION['ownerId']);

    $query = "SELECT t.*, GROUP_CONCAT(p.name SEPARATOR ', ') AS items, GROUP_CONCAT(ti.Quantity SEPARATOR ', ') AS quantities
            FROM transactions t
            LEFT JOIN transactionitems ti ON t.Id = ti.transaction_id
            LEFT JOIN products p ON ti.product_id = p.Id
            WHERE t.Owner_Id = '$ownerId'
            GROUP BY t.Id";
    $result = mysqli_query($conn, $query);

    $transactions = [];

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $transactions[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($transactions);
?>