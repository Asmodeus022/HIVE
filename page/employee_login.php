<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css">
        
        <title>HIVE</title>
    </head>
    <body>
        <?php
            include "../includes/loginEmployeeHandler.php";
        
        ?>
        <div class="row p-0 m-0" style="height: 100vh">
            <div class="col-5 p-0 h-100">
                <div style="height: 40px">
                    <h3 class="logotype p-0 pt-2 m-0 ms-3">HIVE</h3>
                </div>
                <div class="hive_logo d-flex justify-content-center align-items-center" style="height: calc(100vh - 50px)">
                    <img src="../assets/images/HIVE SVG BRAND.svg" alt="">
                </div>
            </div>

            <div class="col-7 p-0 h-100">
                <div class="h-100 w-100 d-flex justify-content-center align-items-center">
                    <div class="w-100" style="max-width: 80%">
                        <h2 class="title">Welcome back!</h2>
                        <p class="subtitle">Please log into your account.</p>
                        <form action="" method="POST">
                            <div class="mb-3 mt-5">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-1">
                                <label for="pword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="pword" id="pword">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="registration_page.php">Ceate Account</a>
                                <a href="password_recovery.php">Forgot Password</a>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-hive" type="submit" name="loginUser">LOG IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>