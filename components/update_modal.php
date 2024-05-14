<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .file-upload {
            height: 100%;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="modal update_modal fade" id="staticBackdrop_update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../components/forms/prodUpdateForm.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-5">
                            <input type="file" class="form-control file-upload" name="product_image" id="product_image_update" accept="image/*">
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="productName" id="productName_update" placeholder="" required>
                            </div>
                            <div id="error-pName-message" style="color: red;"></div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" name="category" id="category_update" placeholder="">
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Product ID</label>
                                        <input type="text" class="form-control" name="product_id" id="product_id_update" placeholder="" required>
                                    </div>
                                    <div id="error-pId-message" style="color: red;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" class="form-control" name="brand" id="brand_update" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" id="price_update" placeholder="" required>
                                    </div>
                                    <div id="error-price-message" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity_update" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="daily_ave" class="form-label">Daily Average Sale</label>
                                        <input type="number" class="form-control" name="daily_ave" id="daily_ave_update" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="render_point" class="form-label">Reorder Point</label>
                                        <input type="number" class="form-control" name="render_point" id="render_point_update" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update_product">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
    // function validateForm() {
    //     var productName = document.getElementById("productName").value;
    //     var productId = document.getElementById("product_id").value;
    //     var price = document.getElementById("price").value;

    //     var isValid = true;

    //     if (productName.trim() === "") {
    //         var errorPNameMessage = "Product Name is required.<br>";
    //         document.getElementById("error-pName-message").innerHTML = errorPNameMessage;
    //         isValid = false;
    //     } else {
    //         document.getElementById("error-pName-message").innerHTML = "";
    //     }
    //     if (productId.trim() === "") {
    //         var errorPIdMessage = "Product ID is required.<br>";
    //         document.getElementById("error-pId-message").innerHTML = errorPIdMessage;
    //         isValid = false;
    //     } else {
    //         document.getElementById("error-pId-message").innerHTML = "";
    //     }
    //     if (price.trim() === "") {
    //         var errorPPriceMessage = "Price is required.<br>";
    //         document.getElementById("error-price-message").innerHTML = errorPPriceMessage;
    //         isValid = false;
    //     } else {
    //         document.getElementById("error-price-message").innerHTML = "";
    //     }

    //     return isValid;
    // }
    <script>
    // Define a function to fetch product data and populate the form fields
    function populateForm(productId) {
        // Make an AJAX request to prodUpdateForm.php
        $.ajax({
            url: '../components/forms/prodUpdateForm.php',
            method: 'POST',
            data: { productId: productId },
            dataType: 'json',
            success: function(response) {
                // Check if the response contains any errors
                if (response.error) {
                    // Handle the error (e.g., display an error message)
                    console.error(response.error);
                    return;
                }

                // Populate the form fields with the retrieved data
                $('#productName_update').val(response.Name);
                $('#category_update').val(response.Category);
                $('#product_id_update').val(response.Id);
                $('#brand_update').val(response.Brand);
                $('#price_update').val(response.Price);
                $('#quantity_update').val(response.Quantity);
                $('#daily_ave_update').val(response.Daily_Ave);
                $('#render_point_update').val(response.Render_Point);

                // Show the modal
                $('#staticBackdrop_update').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle the AJAX error (e.g., display an error message)
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        // Add an event listener to the update button
        $(document).on('click', '.update-btn', function() {
            // Get the product ID from the data attribute
            var productId = $(this).data('product-id');
            
            // Call the populateForm function with the product ID
            populateForm(productId);
        });
    });
</script>
</script>
</body>
</html>
