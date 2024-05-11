<?php 
    session_start();

    if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
        header("Location: page/login.php");
        exit;
    }

    else {
        echo $_SESSION['email'];
        echo $_SESSION['password'];
    }

    // require_once "includes/sessionDestroyer.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <div class="d-flex p-0 m-0" style="height: 100vh">
        <div class="col-1 p-0 m-0 h-100" style="min-width: 100px">
            <?php include './components/sidebar.php'; ?>
        </div>
        <div class="col p-0 m-0">
            <div class="row">

            </div>
        </div>
    </div>
    
</body>
</html>