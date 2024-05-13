<div class="container-fluid p-0 m-0 bg-light sidebar h-100">
    <div class="sidebar-sticky position-relative h-100">
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
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/shopping.php') ? 'active' : ''; ?> p-2" href="./shopping.php">
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

        <div class="btn-group dropup position-absolute bottom-0 start-50 translate-middle-x mb-3 z-3">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="http://127.0.0.1:5500/assets/images/account.svg" style="width: 40px; height: 40px;" alt="">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../includes/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>