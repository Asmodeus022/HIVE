<?php
session_start();
@include "../includes/database.php";

function fetchTotalSales() {
    global $conn;
    $ownerId = $_SESSION['ownerId'];

    $sql = "SELECT SUM(Total_Amount) AS TotalSales 
            FROM transactions 
            WHERE Owner_Id = $ownerId";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['TotalSales'];
    } else {
        return 0;
    }
}

$totalSales = fetchTotalSales();

header('Content-Type: application/json');
echo json_encode(array('totalSales' => $totalSales));
?>
