<?php
    session_start();
    @include "../includes/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['updateEmployeeUsername'];
        $password = $_POST['updatePassword'];
        $role = $_POST['updateEmployeeRole'];
        $selectedEmployeeId = $_POST['selectedEmployeeId'];

        if (!empty($username) && !empty($password) && !empty($role) && !empty($selectedEmployeeId)) {
            // Use UPDATE statement with SET clause
            $query = "UPDATE employees SET Username='$username', `Password`='$password', `Role`='$role' WHERE Id='$selectedEmployeeId'";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                echo "Employee updated successfully";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Please fill out all required fields";
        }
    }
?>