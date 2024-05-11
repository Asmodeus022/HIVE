<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container-fluid p-0 m-0 bg-light sidebar h-100">
        <div class="sidebar-sticky">
            <div class="container-fluid">
                <a class="navbar-brand d-flex justify-content-center" href="#">                        
                    <img src="http://127.0.0.1:5500/assets/images/HIVE SVG BRAND.svg" style="width: 85px; height: 85px;" alt="">
                </a>
            </div>
            <ul class="nav flex-column align-items-center mt-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/dashboard.php') ? 'active' : ''; ?> p-2" href="./dashboard.php">
                        <img src="http://127.0.0.1:5500/assets/images/dashboard.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/shopping.php') ? 'active' : ''; ?> p-2" href="./dashboard.php">
                        <img src="http://127.0.0.1:5500/assets/images/shopping.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/inventory.php') ? 'active' : ''; ?> p-2" href="./inventory.php">
                        <img src="http://127.0.0.1:5500/assets/images/inventory.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/people.php') ? 'active' : ''; ?> p-2" href="./dashboard.php">
                        <img src="http://127.0.0.1:5500/assets/images/handshake.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/transaction.php') ? 'active' : ''; ?> p-2" href="./dashboard.php">
                        <img src="http://127.0.0.1:5500/assets/images/transact.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/records.php') ? 'active' : ''; ?> p-2" href="./dashboard.php">
                        <img src="http://127.0.0.1:5500/assets/images/chart.svg" style="width: 40px; height: 40px;" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
