<?php
    @include "../includes/database.php";

    function fetchTotalSoldQuantity($productId) {
        global $conn;
        $sql = "SELECT SUM(Quantity) AS TotalSold FROM transactionitems WHERE Product_Id = $productId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return 0;
        }
    }
    
    if(isset($_POST['productId'])) {
        $productId = $_POST['productId'];
        $totalSoldQuantity = fetchTotalSoldQuantity($productId);

        header('Content-Type: application/json');
        echo json_encode($totalSoldQuantity);
        exit;
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'ProductId is missing in the request'));
        exit;
    }
?>
