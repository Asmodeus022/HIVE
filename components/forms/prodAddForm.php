
<?php
    session_start();
    require_once("../../includes/database.php");

    if ( isset($_POST['add_product'])) {
        echo "asdfghjklrtyu";
        // Check if a file is uploaded
        if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            // File upload directory
            $targetDirectory = "./../../includes/phpupload/uploads/";
            // File name
            $targetFile = basename($_FILES["product_image"]["name"]);
            $pathDirectory = $targetDirectory . basename($_FILES["product_image"]["name"]);
            // Attempt to move the file
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $pathDirectory)) {
                echo "File uploaded Successfully";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Retrieve form data
        $productName = $_POST["productName"];
        $categoryId = $_POST["category"];
        $productId = $_POST["product_id"];
        $brand = $_POST["brand"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $dailyAverageSale = $_POST["daily_ave"];
        $renderPoint = $_POST["render_point"];
        $ownerId = $_SESSION['ownerId'];
        $filePath = isset($targetFile) ? $targetFile : null; // File path

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO products (Name, Category, Id, Brand, Price, Stocks, Daily_Ave, Render_Point, Owner_Id, file_Path)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisdddiis", $productName, $categoryId, $productId, $brand, $price, $quantity, $dailyAverageSale, $renderPoint, $ownerId, $filePath);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../../page/inventory.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
        // Close the connection
        $conn->close();
    }
?>
