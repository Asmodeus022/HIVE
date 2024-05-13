<?php

    session_start();
    @include "./cross_access.php";
    @include "../includes/database.php";
    @include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .payment-method {
                margin-bottom: 20px;
            }

            .payment-method label {
                display: inline-block;
                margin-right: 20px;
                cursor: pointer;
            }

            .payment-method input[type="radio"] {
                display: none;
            }

            .payment-method span {
                display: inline-block;
                width: 80px;
                height: 50px;
                line-height: 30px;
                text-align: center;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #fff;
            }

            .payment-method input[type="radio"]:checked + span {
                background-color: #007bff;
                color: #fff;
            }

            .product-card:hover {
                border-color: #007bff;
            }

        </style>
    </head>
<body>
    <div class="row p-0 m-0" style="height: 100vh; overflow: hidden">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Send To</h1>
                        <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select share-user" aria-label="Share To">
                            <option selected disabled>Select User to Share</option>
                            <?php
                                $userQuery = "SELECT * FROM owners WHERE Id != " . $_SESSION['ownerId'];
                                $userResult = mysqli_query($conn, $userQuery);
                                while ($userRow = mysqli_fetch_assoc($userResult)) {
                                    echo "<option value='" . $userRow['Id'] . "'>" . $userRow['Username'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary sendTo">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row p-4 h-100">
                <div class="col-9">
                    <div class="d-flex">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="searchItem" placeholder="Search Item">
                        </div>
                    </div>
                    <div id="productContainer" class="row" style="overflow: auto; max-height: 80vh"></div>
                </div>
                <div class="col-3">
                    <div class="h-100 border rounded-3 position-relative" style="background-color: white">
                        <div class="mt-3 ms-3">
                            <h4 class="p-0 m-0">Checkout</h4>
                        </div>

                        <div id="selectedItemsList" class="p-3"></div>

                        <div class="position-absolute bottom-0 start-50 translate-middle-x">
                            <div class="d-flex justify-content-between">
                                <p>Total Amount</p>
                                <p class="totalAmount"></p>
                            </div>
                            <p class="pb-2 m-0" style="font-weight: 600">Payment Method</p>
                            <div class="d-flex">
                                <label class="payment-method me-1">
                                    <input type="radio" name="payment" value="cash">
                                    <span>Cash</span>
                                </label>
                                <label class="payment-method me-1">
                                    <input type="radio" name="payment" value="card">
                                    <span>Card</span>
                                </label>
                                <label class="payment-method me-1">
                                    <input type="radio" name="payment" value="ewallet">
                                    <span>E-Wallet</span>
                                </label>
                                <label class="payment-method">
                                    <input type="radio" name="payment" value="others">
                                    <span>Others</span>
                                </label>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <div class="btn btn-hive addTransact">Checkout</div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Send To</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        var selectedItems = [];
        var totalAmount = 0;

        function addToSelectedItems(productId, productName, productCategory, productPrice, productImage) {
            console.log(productId);
            var existingItem = selectedItems.find(item => parseInt(item.id) === parseInt(productId));
            if (existingItem) {
                existingItem.quantity++;
            } else {
                selectedItems.push({ id: productId, name: productName, category: productCategory, price: productPrice, quantity: 1, image: productImage });
            }
            updateSelectedItemsList();
        }



        function incrementQuantity(productId) {
            var selectedItemIndex = selectedItems.findIndex(item => item.id === productId);
            console.log(selectedItemIndex);
            console.log(productId);
            if (selectedItemIndex !== -1) {
                selectedItems[selectedItemIndex].quantity++;
                updateSelectedItemsList();
            }
        }

        function decrementQuantity(productId) {
            var selectedItemIndex = selectedItems.findIndex(item => item.id === productId);
            if (selectedItemIndex !== -1 && selectedItems[selectedItemIndex].quantity > 1) {
                selectedItems[selectedItemIndex].quantity--;
                updateSelectedItemsList();
            }
        }

        function deleteItem(productId) {
            var selectedItemIndex = selectedItems.findIndex(item => item.id === productId);
            if (selectedItemIndex !== -1) {
                selectedItems.splice(selectedItemIndex, 1);
                updateSelectedItemsList();
            }
        }


        function updateSelectedItemsList() {
            var selectedItemsList = $('#selectedItemsList');
            selectedItemsList.empty();
            
            if (selectedItems.length > 0) {
                selectedItems.forEach(function(item) {
                    var productPriceNumeric = parseFloat(item.price.replace(/[^\d.]/g, ''));
                    var itemTotal = productPriceNumeric * item.quantity;
                    totalAmount += itemTotal;
                    selectedItemsList.append(
                        `<div class='d-flex'>
                            <img src='${item.image}' style='width: 100px; height: 100px;' alt='Image'>
                            <div class='row w-100 d-flex justify-content-center'>
                                <div class='col'>
                                    <p>${item.name}</p>
                                    <p>${item.category}</p>
                                </div>
                                <div class='col text-end'>
                                    <p>${item.price}</p>
                                    <div class='d-flex'>
                                        <button class='btn' onclick='incrementQuantity(${item.id})'>+</button>
                                        <p>${item.quantity}</p>
                                        <button class='btn' onclick='decrementQuantity(${item.id})'>-</button>
                                        <button class='btn' onclick='deleteItem(${item.id})'>delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    );
                });
            } else {
                selectedItemsList.append('<p>No items selected</p>');
            }
            
            $('.totalAmount').text('₱ ' + totalAmount.toFixed(2));
        }


        $(document).ready(function(){
            $('#searchItem').on('keyup', function(){
                var searchText = $(this).val().toLowerCase();
                $('#productContainer .product-card').each(function(){
                    var productName = $(this).find('.card-title').text().toLowerCase();
                    var category = $(this).find('.card-category').text().toLowerCase();
                    if(productName.includes(searchText) || category.includes(searchText)){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.product-card').click(function() {
                var productId = $(this).data('product-id');
                var productName = $(this).find('.card-title').text();
                var productCategory = $(this).find('.card-category').text();
                var productPrice = $(this).find('.card-price').text();
                var productImage = $(this).find('.card-img-top').attr('src');
                console.log(productImage);
                addToSelectedItems(productId, productName, productCategory, productPrice, productImage);
            });

        
        });

        $('.addTransact').click(function() {
            var paymentMethod = $('input[name="payment"]:checked').val();
            if (!paymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            console.log(totalAmount);
            $.ajax({
                type: "POST",
                url: "../components/forms/addTransaction.php",
                data: {
                    selectedItems: selectedItems,
                    paymentMethod: paymentMethod,
                    totalAmount: totalAmount,
                },
                success: function(response) {
                    console.log(response);
                    alert('Checkout successful!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error occurred. Please try again.');
                }
            });
        });


        $(document).ready(function(){
            $('.sendTo').click(function() {
                var sharedWithId = $('.share-user').val();
                
                if (!sharedWithId) {
                    alert('Please select a user to share the product with.');
                    return;
                }

                var productIds = selectedItems.map(item => item.id);

                $.ajax({
                    type: "POST",
                    url: "../includes/share_product.php",
                    data: {
                        sharedWithId: sharedWithId,
                        productIds: productIds
                    },
                    success: function(response) {
                        alert('Send successful!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred. Please try again.');
                    }
                });
            });
        });

    </script>
    <script src="../assets/js/shopping.js"></script>
</body>
</html>