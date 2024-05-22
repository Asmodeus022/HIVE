<?php
    session_start();
    @include "../includes/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST['employeeFullname'];
        $email = $_POST['employeeEmail'];
        $password = $_POST['employeePassword'];
        $role = $_POST['employeeRole'];
        $ownerId = $_SESSION['ownerId'];

        if (!empty($fullName) && !empty($email) && !empty($password) && !empty($role) && !empty($ownerId)) {
            $query = "SELECT id FROM emails WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $emailId);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if (!$emailId) {
                $query = "INSERT INTO emails (email) VALUES (?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 's', $email);
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }
                $emailId = mysqli_insert_id($conn);
                mysqli_stmt_close($stmt);
            }

            $query = "INSERT INTO employees (`Full_Name`, `Email`, `Password`, `Role`, `Owner_Id`, `email_id`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssii', $fullName, $email, $password, $role, $ownerId, $emailId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Employee added successfully";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Please fill out all required fields";
        }
    }
?>