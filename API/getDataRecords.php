<?php
    session_start();
    include "../includes/database.php";

    $query = "SELECT DATE(Created_At) AS date, SUM(Total_Amount) AS total_amount FROM transactions GROUP BY DATE(Created_At)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $labels = [];
        $totalAmountData = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['date'];
            $totalAmountData[] = $row['total_amount'];
        }

        $response = array(
            'labels' => $labels,
            'totalAmountData' => $totalAmountData
        );

        echo json_encode($response);
    } else {
        $response = array(
            'error' => 'Failed to fetch data from the database'
        );
        echo json_encode($response);
    }
?>
