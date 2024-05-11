<?php
    session_start();
    include "database.php";

    function authenticateUser($email, $pword)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT `email`, `pword` FROM `managers` WHERE `email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
            $password = $row['pword'];

            if (md5($pword) == $password) {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
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