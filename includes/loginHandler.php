<?php
    session_start();
    include "database.php";

    function authenticateUser($email, $pword)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT `Email`, `Password`, `Id`, `Role` FROM `managers` WHERE `Email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['Email'];
            $password = $row['Password'];
            $managerId = $row['Id'];
            $role = $row['Role'];

            if (md5($pword) == $password) {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['managerId'] = $managerId;
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['pword'];
        authenticateUser($_SESSION['email'], $_SESSION['password']);
    }
?>