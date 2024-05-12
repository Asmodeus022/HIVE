<?php
session_start();
require_once("../../includes/database.php");

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Retrieve product information from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE Id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the product data
        $productData = $result->fetch_assoc();

        // Encode the product data as JSON and return it
        header('Content-Type: application/json');
        echo json_encode($productData);
    } else {
        // If no product found with the given ID
        echo json_encode(array('error' => 'Product not found'));
    }
} else {
    // If product ID is not provided
    echo json_encode(array('error' => 'Product ID not provided'));
}
?>
