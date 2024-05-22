<?php
    session_start();
    @include "../includes/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST['updateEmployeeFullname'];
        $email = $_POST['updateEmployeeEmail'];
        $password = $_POST['updateEmployeePassword'];
        $role = $_POST['updateEmployeeRole'];
        $selectedEmployeeId = $_POST['selectedEmployeeId'];

        if (!empty($email) && !empty($password) && !empty($role) && !empty($selectedEmployeeId)) {
            // Use UPDATE statement with SET clause
            $query = "UPDATE employees SET Full_Name='$fullName', Email='$email', `Password`='$password', `Role`='$role' WHERE Id='$selectedEmployeeId'";
            
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