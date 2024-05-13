<?php
session_start();
@include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerId = $_SESSION['ownerId'];
    $productIds = $_POST['productIds'];
    $sharedWithId = $_POST['sharedWithId'];

    if (!is_numeric($sharedWithId) || !is_array($productIds)) {
        $response = array("status" => "error", "message" => "Invalid data format");
        echo json_encode($response);
        exit();
    }

    foreach ($productIds as $productId) {
        $checkQuery = "SELECT * FROM sharedproducts WHERE Product_Id = '$productId' AND Shared_With_Owner_Id = '$sharedWithId'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            continue;
        }

        $query = "INSERT INTO sharedproducts (Product_Id, Owner_Id, Shared_With_Owner_Id) VALUES ('$productId', '$ownerId', '$sharedWithId')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            $response = array("status" => "error", "message" => "Failed to share product(s)");
            echo json_encode($response);
            exit();
        }
    }

    $response = array("status" => "success", "message" => "Product(s) shared successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
