<?php
session_start();
include "../includes/database.php";

// Get the start and end dates from the request
$startDate = $_GET['start_date'];
$endDate = $_GET['end_date'];

$query = "SELECT DATE(Created_At) AS date, SUM(Total_Amount) AS total_amount 
          FROM transactions 
          WHERE DATE(Created_At) BETWEEN '$startDate' AND '$endDate' 
          GROUP BY DATE(Created_At)";
$result = mysqli_query($conn, $query);

if ($result) {
    $labels = [];
    $totalAmountData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['date'];  // Add the date to labels array
        $totalAmountData[] = $row['total_amount'];  // Add the total amount to data array
    }

    $response = array(
        'labels' => $labels,  // This will be used as labels in the chart
        'totalAmountData' => $totalAmountData  // This will be used as data in the chart
    );

    echo json_encode($response);
} else {
    $response = array(
        'error' => 'Failed to fetch data from the database'
    );
    echo json_encode($response);
}
?>
