<?php
session_start();
include "database.php";

function authenticateUser($username, $pword)
{
    global $conn;
    $stmt = $conn->prepare("SELECT `Username`, `Password`, `Id`, `Role`, `Manager_Id` FROM `employees` WHERE `Username` = ?");
    $stmt->bind_param("s", $username); // Corrected parameter name
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fetchedUsername = $row['Username'];
        $managerId = $row['Manager_Id'];
        $password = $row['Password'];
        $userId = $row['Id'];
        $role = $row['Role'];

        if ($pword == $password && $username == $fetchedUsername) {
            $_SESSION['username'] = $username;
            $_SESSION['managerId'] = $managerId;
            $_SESSION['password'] = $password;
            $_SESSION['userId'] = $userId;
            $_SESSION['role'] = $role;
            header("Location: ../page/dashboard.php");
            exit();
        } else {
            echo '<div class="alert-modal failed">Invalid password!</div>';
        }
    } else {
        echo '<div class="alert-modal failed">Invalid username!</div>';
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loginUser'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['pword'];
    authenticateUser($_SESSION['username'], $_SESSION['password']);
}
?>
