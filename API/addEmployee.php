<?php
    session_start();
    @include "../includes/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['employeeUsername'];
        $password = $_POST['password'];
        $role = $_POST['employeeRole'];
        $ownerId = $_SESSION['ownerId'];

        if (!empty($username) && !empty($role) && !empty($ownerId)) {
            $query = "INSERT INTO employees (Username, `Password`, `Role`, Owner_Id) VALUES ('$username', '$password', '$role', '$ownerId')";
            
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                echo "Employee added successfully";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Please fill out all required fields";
        }
    }
?>