<?php
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";

    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }

    $welcomeMessage = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : '';
    unset($_SESSION['welcome_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- <style>
        .custom-alert {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: block; /* Initially hidden */
            animation: fadeInDown 0.5s forwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style> -->
</head>
<body>
    <?php if ($welcomeMessage): ?>
        <div class='alert-modal success d-flex'><?php echo $welcomeMessage; ?></div>
    <?php endif; ?>
    <div class="row p-0 m-0" style="height: 100vh">

        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row p-3 h-100">
                <h3 class="mb-4">Dashboard</h3>
                <div class='row'>
                    <div class="col-12">
                        <h3>Recent Transaction</h3>
                        <table id="myTable" class="hover table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class='text-center'>Items</th>
                                    <th>Total Amount</th>
                                    <th>Cashier</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="recentTransactBody"></tbody>
                        </table>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-9 h-75">
                        <div class='d-flex align-items-center'>
                            <h3 class="mr-3">Monthly Sales</h3>
                            <input type="text" id="dateRangePicker" class="form-control" style="max-width: 250px; margin-left: 15px;" />
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="col-3 h-75">
                        <h3>Total Sales</h3>
                        <canvas id="myPieChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script>
        var myChartInstance = null;

        $(document).ready(function() {
            // Initialize date range picker
            $('#dateRangePicker').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                fetchMonthlySalesData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });

            // Function to fetch monthly sales data
            function fetchMonthlySalesData(startDate, endDate) {
                $.ajax({
                    url: '../API/getMonthlySalesData.php',
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.error) {
                            console.error(data.error);
                            alert('Error occurred while fetching data. Please try again.');
                            return;
                        }

                        var labels = data.labels;
                        var totalAmountData = data.totalAmountData;

                        var ctx = document.getElementById('myChart').getContext('2d');
                        
                        // Destroy the previous chart instance if it exists
                        if (myChartInstance) {
                            myChartInstance.destroy();
                        }

                        // Create a new chart instance
                        myChartInstance = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,  // Dates
                                datasets: [{
                                    label: 'Total Amount',
                                    data: totalAmountData,  // Amounts
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while fetching data. Please try again.');
                    }
                });
            }

            // Initial fetch for the current month
            var startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
            var endOfMonth = moment().endOf('month').format('YYYY-MM-DD');
            fetchMonthlySalesData(startOfMonth, endOfMonth);
        });
    </script>
</body>
</html>
