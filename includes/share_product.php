<?php
    session_start();
    @include "database.php";

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming the current user is the owner
        $ownerId = $_SESSION['ownerId'];
        $productIds = $_POST['productIds'];
        $sharedWithId = $_POST['sharedWithId'];

        // Validate data
        if (!is_numeric($sharedWithId) || !is_array($productIds)) {
            $response = array("status" => "error", "message" => "Invalid data format");
            echo json_encode($response);
            exit();
        }

        // Insert shared products into shared_products table
        foreach ($productIds as $productId) {
            $query = "INSERT INTO sharedproducts (Product_Id, Owner_Id, Shared_With_Owner_Id) VALUES ('$productId', '$ownerId', '$sharedWithId')";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                $response = array("status" => "error", "message" => "Failed to share product(s)");
                echo json_encode($response);
                exit();
            }
        }

        // Return success response
        $response = array("status" => "success", "message" => "Product(s) shared successfully");
        echo json_encode($response);
    } else {
        // Return error response for invalid request method
        $response = array("status" => "error", "message" => "Invalid request method");
        echo json_encode($response);
    }
?>