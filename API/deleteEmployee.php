<?php
    session_start();
    @include "../includes/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employeeId"])) {
        $employeeId = $_POST["employeeId"];
        $ownerId = $_SESSION["ownerId"];

        $deleteQuery = "DELETE FROM employees WHERE Id = $employeeId AND Owner_Id = $ownerId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        http_response_code(400);
        echo "Invalid request!";
    }
?>