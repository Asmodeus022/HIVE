<?php
session_start();
require_once("../../includes/database.php");

if (isset($_POST['update_product'])) {
    $productId = $_POST['product_id'];

    // Retrieve the updated data from the form
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $dailyAve = $_POST['daily_ave'];
    $renderPoint = $_POST['render_point'];

    // Update the product information in the database
    $stmt = $conn->prepare("UPDATE products SET `Name`=?, Category=?, Brand=?, Price=?, Stocks=?, Daily_Ave=?, Render_Point=? WHERE Id=?");
    $stmt->bind_param("sssssssi", $productName, $category, $brand, $price, $quantity, $dailyAve, $renderPoint, $productId);

    if ($stmt->execute()) {
        // If the update was successful, return a success message
        echo json_encode(array('success' => 'Product updated successfully'));
    } else {
        // If the update failed, return an error message
        echo json_encode(array('error' => 'Failed to update product'));
    }
} else {
    // If the form submission is not valid, return an error message
    echo json_encode(array('error' => 'Invalid form submission'));
}
?>
