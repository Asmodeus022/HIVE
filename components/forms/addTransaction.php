<?php
session_start();
@include "../../includes/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedItems = $_POST["selectedItems"];
    $paymentMethod = $_POST["paymentMethod"];
    $totalAmount = $_POST["totalAmount"];
    $cashier = $_SESSION["username"];
    $ownerId = $_SESSION["ownerId"];
    
    mysqli_begin_transaction($conn);

    try {
        $insertTransactionQuery = "INSERT INTO transactions (payment_method, total_amount, cashier, owner_id) VALUES ('$paymentMethod', '$totalAmount', '$cashier', '$ownerId')";
        mysqli_query($conn, $insertTransactionQuery);
        $transactionId = mysqli_insert_id($conn);
        
        foreach ($selectedItems as $item) {
            $productId = $item["id"];
            $quantity = $item["quantity"];
            
            // Check if the product ID is in sharedproducts
            $checkSharedProductQuery = "SELECT COUNT(*) as count FROM sharedproducts WHERE Product_Id = $productId AND Shared_With_Owner_Id = $ownerId";
            $result = mysqli_query($conn, $checkSharedProductQuery);
            $row = mysqli_fetch_assoc($result);
            $isSharedProduct = ($row['count'] > 0);

            if ($isSharedProduct) {
                // Subtract from the Quantity field of sharedproducts
                $updateSharedProductQuery = "UPDATE sharedproducts SET Quantity = Quantity - $quantity WHERE Product_Id = $productId AND Shared_With_Owner_Id = $ownerId";
                mysqli_query($conn, $updateSharedProductQuery);
            } else {
                // Subtract from the Stocks field of products
                $updateProductQuery = "UPDATE products SET stocks = stocks - $quantity WHERE Id = $productId";
                mysqli_query($conn, $updateProductQuery);
            }
            
            $insertItemQuery = "INSERT INTO transactionItems (transaction_id, product_id, quantity) VALUES ('$transactionId', '$productId', '$quantity')";
            mysqli_query($conn, $insertItemQuery);
        }

        mysqli_commit($conn);
        
        mysqli_close($conn);
        
        echo "Checkout successful!";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        
        mysqli_close($conn);

        http_response_code(500);
        echo "An error occurred while processing the transaction.";
    }
} else {
    http_response_code(400);
    echo "Invalid request!";
}
?>
