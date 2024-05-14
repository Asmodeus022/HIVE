<?php
    session_start();
    @include "../includes/database.php";

    function fetchTopSoldProducts() {
        global $conn;
        // Fetch the owner's ID from the session
        $ownerId = $_SESSION['ownerId'];
        
        // Modify the SQL query to include a condition for the owner's ID
        $sql = "SELECT ti.Product_Id, SUM(ti.Quantity) AS TotalQuantity 
                FROM transactionitems ti
                INNER JOIN products p ON ti.Product_Id = p.Id
                WHERE p.Owner_Id = $ownerId
                GROUP BY ti.Product_Id
                ORDER BY TotalQuantity DESC
                LIMIT 5";
        
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $labels = array();
            $quantities = array();
            while ($row = $result->fetch_assoc()) {
                // Fetch product name based on Product_Id
                $productId = $row['Product_Id'];
                $productName = getProductById($productId); // Fetch product name using productId
                $labels[] = $productName;
                $quantities[] = $row['TotalQuantity'];
            }
            return array('labels' => $labels, 'quantities' => $quantities);
        } else {
            return array('error' => 'No data found');
        }
    }

    // Function to get product name by ID
    function getProductById($productId) {
        global $conn;
        $sql = "SELECT Name FROM products WHERE Id = $productId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Name'];
        } else {
            return 'Unknown Product';
        }
    }

    // Call the function to fetch top 5 sold products
    $topSoldProducts = fetchTopSoldProducts();

    // Return the data as JSON response
    header('Content-Type: application/json');
    echo json_encode($topSoldProducts);
?>
