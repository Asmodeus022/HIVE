<?php
session_start();
@include "../../includes/database.php";

// Check if data is received from the frontend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $selectedItems = $_POST["selectedItems"];
    $paymentMethod = $_POST["paymentMethod"];
    $totalAmount = $_POST["totalAmount"];
    $sessionRole = $_POST["sessionRole"];
    
    // Insert checkout details into the transaction table
    $insertTransactionQuery = "INSERT INTO transactions (payment_method, total_amount, cashier) VALUES ('$paymentMethod', '$totalAmount', '$sessionRole')";
    mysqli_query($conn, $insertTransactionQuery);
    $transactionId = mysqli_insert_id($conn);
    
    // Insert selected items into the transactionItems table
    foreach ($selectedItems as $item) {
        $productId = $item["id"];
        $quantity = $item["quantity"];
        $insertItemQuery = "INSERT INTO transactionItems (transaction_id, product_id, quantity) VALUES ('$transactionId', '$productId', '$quantity')";
        mysqli_query($conn, $insertItemQuery);
    }
    
    // Close database connection
    mysqli_close($conn);
    
    // Send response to frontend (if needed)
    echo "Checkout successful!";
} else {
    // Handle invalid request
    http_response_code(400);
    echo "Invalid request!";
}
?>
