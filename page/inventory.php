<?php 
    @include "../includes/database.php";
    @include "../includes/header.php";
    @include "../components/modal.php";
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
                                <p class="">0 pcs</p>
                            </div>
                            <div class="col-6">
                                <p class="">Available</p>
                                <p class="">0 pcs</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column h-75">
                            <p class="">Daily Demand Forecast</p>
                            <div class="col d-flex justify-content-center align-items-center">
                                <h2 class="" id="dailyAverageSale">0</h2>
                            </div>
                            <p class="">Item Reorder Point</p>
                            <div class="col d-flex justify-content-center align-items-center">
                                <h2 class="">0</h2>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col ps-4">
                    <div class="h-100 border rounded-3" style="background-color: white">
                        <div class="mt-3 me-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-hive" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Item</button>
                        </div>
                        <div class="p-2">
                            <table id="myTable" class="hover table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Image</th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stocks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM products";

                                        $result = mysqli_query($conn, $sql);
                                    
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td></td>";
                                                echo "<td><img src='../includes/phpupload/uploads/{$row['file_path']}' style='width: 100px; height: 100px;' alt='Image'></td>";
                                                echo "<td>{$row['Id']}</td>";
                                                echo "<td>{$row['Name']}</td>";
                                                echo "<td>{$row['Brand']}</td>";
                                                echo "<td>{$row['Price']}</td>";
                                                echo "<td>{$row['Stocks']}</td>";
                                                echo "</tr>";
                                            }
                                        }                                        
                                         else {
                                            echo "<tr><td colspan='5'>No data found</td></tr>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script src="../assets/js/inventory.js"></script>
</body>
</html>