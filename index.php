<?php 
    session_start();

    if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
        header("Location: page/login.html");
        exit;
    }

    // require_once "includes/sessionDestroyer.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>