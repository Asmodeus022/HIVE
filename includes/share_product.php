<?php
session_start();
@include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerId = $_SESSION['ownerId'];
    $productIds = $_POST['productIds'];
    $quantities = $_POST["quantities"];
    $sharedWithId = $_POST['sharedWithId'];

    if (!is_numeric($sharedWithId) || !is_array($productIds) || count($productIds) !== count($quantities)) {
        $response = array("status" => "error", "message" => "Invalid data format");
        echo json_encode($response);
        exit();
    }

    $success = true;

    foreach ($productIds as $key => $productId) {
        $quantity = $quantities[$key];

        $checkQuery = "SELECT * FROM sharedproducts WHERE Product_Id = '$productId' AND Shared_With_Owner_Id = '$sharedWithId'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            continue;
        }

        $query = "INSERT INTO sharedproducts (Product_Id, Quantity, Owner_Id, Shared_With_Owner_Id) VALUES ('$productId', '$quantity', '$ownerId', '$sharedWithId')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $response = array("status" => "success", "message" => "Product(s) shared successfully");
        echo json_encode($response);
        exit();
    } else {
        $response = array("status" => "error", "message" => "Failed to share product(s)");
        echo json_encode($response);
        exit();
    }
} else {
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
