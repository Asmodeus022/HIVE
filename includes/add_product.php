<?php
@include 'database.php';

if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_average_sale = $_POST['product_average_sale'];
    $product_reorder_point = $_POST['product_reorder_point'];

    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    $insert = "INSERT INTO products(product_name, product_category, product_brand, product_price, product_quantity, product_average_sale, product_reorder_point, product_image) VALUES('$product_name', '$product_category', '$product_brand', '$product_price', '$product_quantity', '$product_average_sale', '$product_reorder_point', '$product_image')";

        $upload = mysqli_query($conn, $insert);
        if($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            // File uploaded successfully
        } else {
            // Error in SQL query
            echo mysqli_error($conn);
        }

    // if(empty($product_name) || empty($product_category) || empty($product_brand) || empty($product_price) || empty($product_quantity) || empty($product_average_sale) || empty($product_reorder_point) || empty($product_image)) {
    //     // Handle empty fields
    // }
    // else {
        
    // }
    }
?>
