<?php
@include "./database.php";

function fetchDailyAverageSales($productId) {
    global $conn;
    $sql = "SELECT Daily_Ave AS daily_average_sales FROM products WHERE Id = $productId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['daily_average_sales'];
    } else {
        return 0;
    }
}

if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $dailyAverageSales = fetchDailyAverageSales($productId);

    header('Content-Type: application/json');
    echo json_encode($dailyAverageSales);
    exit;
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'ProductId is missing in the request'));
    exit;
}
?>
