<?php
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";
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
                <h3 class=" mb-4">Transaction</h3>
                <table id="myTable" class="hover table table-striped text-center" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Cashier</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script src="../assets/js/transaction.js"></script>
</body>
</html>