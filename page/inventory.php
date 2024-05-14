<?php 
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";
    @include "../components/add_modal.php";
    @include "../components/update_modal.php";
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="row p-0 m-0" style="height: 100vh; overflow: hidden">
        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row p-3 h-100">
                <div class="col-3">
                    <h3 class=" mb-4">Inventory</h3>
                    <div class="my-3">
                        <h4><label for="search" class="form-label">Search Items</label></h4>
                        <input type="text" class="form-control" id="search" placeholder="Search Items">
                    </div>

                    <div class="mt-5 p-3 rounded-3" style="background-color: white; height: calc(100% - 190px)">
                        <h4 class="m-0 p-0 mb-3">Overview</h4>
                        <div class="d-flex">
                            <div class="col-6 mb-4">
                                <p class="">Sold</p>
                                <p class=""><span id='sold'>0</span> pcs</p>
                            </div>
                            <div class="col-6">
                                <p class="">Available</p>
                                <p class=""><span id='available'>0</span> pcs</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column h-75">
                            <p class="">Daily Demand Forecast</p>
                            <div class="col d-flex justify-content-center align-items-center">
                                <h2 class="" id="dailyAverageSale">0</h2>
                            </div>
                            <p class="">Item Reorder Point</p>
                            <div class="col d-flex justify-content-center align-items-center">
                                <h2 class="" id="renderPoint">0</h2>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col ps-4">
                    <div class="h-100 border rounded-3" style="background-color: white">
                        <div class="mt-3 me-3 d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-primary active mx-2 toggle-btn" data-target="allTable">All</button>
                                <button type="button" class="btn btn-primary toggle-btn" data-target="sharedTable">Shared Item</button>
                            </div>

                            <button type="button" class="btn btn-hive" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Item</button>
                        </div>
                        <div class="p-2">
                            <div id='allTable' style='display: block'>
                                <table id="all-table" class="hover table table-striped text-center" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Stocks</th>
                                            <th>Owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ownerId = $_SESSION['ownerId'];

                                            $sql_company_name = "SELECT Company_Name FROM owners";
                                            $result_company_name = mysqli_query($conn, $sql_company_name);
                                            if ($result_company_name && mysqli_num_rows($result_company_name) > 0) {
                                                $owner_company_name_row = mysqli_fetch_assoc($result_company_name);
                                                $company_name = $owner_company_name_row['Company_Name'];
                                            } else {
                                                $company_name = "Unknown";
                                            }

                                            $sql_owned_products = "SELECT * FROM products WHERE Owner_Id = $ownerId";

                                            $sql_shared_products = "SELECT p.*, sp.Quantity AS Stocks
                                                                    FROM products p
                                                                    INNER JOIN sharedproducts sp ON p.Id = sp.Product_Id
                                                                    WHERE sp.Shared_With_Owner_Id = $ownerId";

                                            $products = [];

                                            $result_owned = mysqli_query($conn, $sql_owned_products);
                                            if ($result_owned) {
                                                while ($row = mysqli_fetch_assoc($result_owned)) {
                                                    $row['Owner'] = ($row['Owner_Id'] == $ownerId) ? "ME" : $company_name;
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
                                                    $row['Owner'] = ($row['Owner_Id'] == $ownerId) ? "ME" : $company_name;
                                                    $row['Quantity'] = $row['Stocks'];
                                                    unset($row['Stocks']);
                                                    $products[] = $row;
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }

                                            if (count($products) > 0) {
                                                foreach ($products as $row) {
                                                    echo "<tr>";
                                                    echo "<td><img src='../includes/phpupload/uploads/{$row['file_path']}' style='width: 100px; height: 100px;' alt='Image'></td>";
                                                    echo "<td>{$row['Id']}</td>";
                                                    echo "<td>{$row['Name']}</td>";
                                                    echo "<td>{$row['Brand']}</td>";
                                                    echo "<td>{$row['Price']}</td>";
                                                    echo "<td>{$row['Quantity']}</td>";
                                                    echo "<td>{$row['Owner']}</td>"; 
                                                    echo "<td>
                                                            <button type=\"button\"
                                                            class=\"btn btn-hive update-btn\" 
                                                            data-bs-toggle=\"modal\"
                                                            data-bs-target=\"#staticBackdrop_update\"
                                                            data-product-id=\"{$row['Id']}\"
                                                            data-product-name=\"{$row['Name']}\"
                                                            data-category=\"{$row['Category']}\"
                                                            data-brand=\"{$row['Brand']}\"
                                                            data-price=\"{$row['Price']}\"
                                                            data-quantity=\"{$row['Quantity']}\"
                                                            data-daily-ave=\"{$row['Daily_Ave']}\"
                                                            data-render-point=\"{$row['Render_Point']}\">Update</button>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>No data found</td></tr>";
                                            }

                                            
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <div id='sharedTable' style='width: 100%; display: block'>
                                <table id="shared-table" class="hover table table-striped text-center" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Stocks</th>
                                            <th>Shared To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ownerId = $_SESSION['ownerId'];
                                            // Fetch products that are shared and shared to you
                                            $sql_shared_to_me = "SELECT p.*, sp.Quantity AS Stocks, o.Company_Name AS Shared_Company_Name
                                                                FROM products p
                                                                INNER JOIN sharedproducts sp ON p.Id = sp.Product_Id
                                                                INNER JOIN owners o ON sp.Shared_With_Owner_Id = o.Id
                                                                WHERE sp.Owner_Id = $ownerId";

                                            $result_shared_to_me = mysqli_query($conn, $sql_shared_to_me);
                                            if ($result_shared_to_me && mysqli_num_rows($result_shared_to_me) > 0) {
                                                while ($row = mysqli_fetch_assoc($result_shared_to_me)) {
                                                    $row['Quantity'] = $row['Stocks'];

                                                    echo "<tr>";
                                                    echo "<td><img src='../includes/phpupload/uploads/{$row['file_path']}' style='width: 100px; height: 100px;' alt='Image'></td>";
                                                    echo "<td>{$row['Id']}</td>";
                                                    echo "<td>{$row['Name']}</td>";
                                                    echo "<td>{$row['Brand']}</td>";
                                                    echo "<td>{$row['Price']}</td>";
                                                    echo "<td>{$row['Quantity']}</td>";
                                                    echo "<td>{$row['Shared_Company_Name']}</td>"; // Display the company name
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No shared products found</td></tr>";
                                            }

                                            mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script src="../assets/js/inventory.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.update-btn', function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var category = $(this).data('category');
                var brand = $(this).data('brand');
                var price = $(this).data('price');
                var quantity = $(this).data('quantity');
                var dailyAve = $(this).data('daily-ave');
                var renderPoint = $(this).data('render-point');
                console.log(productName)

                $('#productName_update').val(productName);
                $('#category_update').val(category);
                $('#product_id_update').val(productId);
                $('#brand_update').val(brand);
                $('#price_update').val(price);
                $('#quantity_update').val(quantity);
                $('#daily_ave_update').val(dailyAve);
                $('#render_point_update').val(renderPoint);

                $('#staticBackdrop_update').modal('show');
            });
        });
        </script>

</body>
</html>