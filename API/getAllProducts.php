<?php
    session_start();
    @include '../includes/database.php';

    $ownerId = $_SESSION['ownerId'];

    $sql_owned_products = "SELECT * FROM products WHERE Owner_Id = $ownerId";

    $sql_shared_products = "SELECT p.*, sp.Quantity AS Stocks
                            FROM products p
                            INNER JOIN sharedproducts sp ON p.Id = sp.Product_Id
                            WHERE sp.Shared_With_Owner_Id = $ownerId";

    $products = [];

    $result_owned = mysqli_query($conn, $sql_owned_products);
    if ($result_owned) {
        while ($row = mysqli_fetch_assoc($result_owned)) {
            $row['Quantity'] = $row['Stocks'];
            unset($row['Stocks']);
            $products[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $result_shared = mysqli_query($conn, $sql_shared_products);
    if ($result_shared) {
        while ($row = mysqli_fetch_assoc($result_shared)) {
            $row['Quantity'] = $row['Stocks'];
            unset($row['Stocks']);
            $products[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    echo json_encode($products);
?>
