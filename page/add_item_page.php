<?php

@include 'db_connection.php';

/* if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_average_sale = $_POST['product_average_sale'];
    $product_reorder_point = $_POST['product_reorder_point'];

    $product_image = $_FILES['product_image'] ['name'];
    $product_image_tmp_name = $_FILES['product_image'] ['tmp_name'];
    $product_image_folder = 'upload_img/'.$product_image;

    if(empty($product_name) || empty($product_category) || empty($product_brand) || empty($product_price) || empty($product_quantity) || empty($product_average_sale) || empty($product_reorder_point) || empty($product_image)) {

    }
    else {
        $insert = "INSERT INTO inventory(product_name, product_category, product_brand, product_price, product_quantity, product_average_sale, product_reorder_point, product_image) VALUES('$product_name', '$product_category', '$product_brand', '$product_price', '$product_price', '$product_quantity', '$product_average_sale', '$product_reorder_point', '$product_image')";

        $upload = mysqli_query($conn, $insert);
        if($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
        }
    }

} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="add_item_page.css">
    <link rel="stylesheet" href="pos_nav.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,300,0,0" />
</head>
<body>

<div class="row">
        <div class="col-1 left">
            <div class="logo">
                <img src="HIVE SVG BRAND.svg" alt="">
            </div>

            <div class="nav">
                <div class="nav_links">
                    <span class="material-symbols-rounded">
                        dashboard
                    </span>
                    <span class="material-symbols-rounded">
                        shopping_bag
                    </span>
                    <span class="material-symbols-rounded">
                        inventory_2
                    </span>
                    <span class="material-symbols-rounded">
                        handshake
                    </span>
                    <span class="material-symbols-rounded">
                        contract
                    </span>
                    <span class="material-symbols-rounded">
                        pie_chart
                    </span>

                    <span class="material-symbols-rounded">
                        photo_auto_merge
                    </span>
                    <span class="material-symbols-rounded">
                        brightness_4
                    </span>
                    <span class="material-symbols-rounded">
                        account_circle
                    </span>
                </div>
            </div>
        </div>

        <div class="col-4"></div>

        <div class="modal col-6" id="modal">
            <div class="modal_container">
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="title">
                        <h4>Add item</h4>
                        <!-- <div class="btn">
                            <span class="material-symbols-rounded">
                                close
                            </span>
                        </div> -->
                    </div>
    
                    <div class="file">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="inputfile">
                        <label for="product_images"></label>
                    </div>
    
                    <div>
                        <div class="upper">
                            <label for="product_name"><h6>Product Name</h6></label>
                            <input type="text" name="product_name" id="">

                            <label for=""><h6>Category</h6></label>
                            <input type="text" name="product_category">

                            <label for=""><h6>Product ID</h6></label>
                            <input type="number" name="product_id">

                            <label for=""><h6>Brand</h6></label>
                            <input type="text" name="product_brand">
                        </div>
    
    
                        <div class="product_info">
                            <div class="col">
                                <label for=""><h6>Price</h6></label>
                                <input type="text" name="product_price">
                            </div>
                            <div class="col">
                                <label for=""><h6>Quantity</h6></label>
                                <input type="number" name="product_quantity">
                            </div>
                        </div>

                        <div class="product_info">
                            <div class="col">
                                <label for=""><h6>Daily Average Sale</h6></label>
                                <input type="text" name="product_average_sale">
                            </div>
    
                            <div class="col">
                                <label for=""><h6>Product Reorder Point</h6></label>
                                <input type="text" name="product_reorder_point">
                            </div>
                        </div>
                    </div>
    
                    <div class="buttons btn">

                        <button type="submit" class="btn cancel"><h5>Cancel</h5></button>
                        <button type="submit" class="btn add" name="add_product">Add Item</button>

                    </div>
                </form>
            </div>


        </div>

        
        
    </div>


    
</body>
</html>

