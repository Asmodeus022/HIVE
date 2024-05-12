<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productName = $_POST["productName"];
    $categoryId = $_POST["category"];
    $productId = $_POST["product_id"];
    $brand = $_POST["brand"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $dailyAverageSale = $_POST["daily_ave"];
    $renderPoint = $_POST["render_point"];

    // Perform database operations (Insert data into your database)
    // This assumes you have a database connection already established
    // and the necessary tables created
    // Here you would typically use prepared statements to prevent SQL injection

    // Example connection
    $conn = new mysqli("localhost", "username", "password", "your_database");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Example SQL query to insert data into a table
    $sql = "INSERT INTO products (productName, categoryId, productId, brand, price, quantity, dailyAverageSale, renderPoint)
            VALUES ('$productName', '$categoryId', '$productId', '$brand', '$price', '$quantity', '$dailyAverageSale', '$renderPoint')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
