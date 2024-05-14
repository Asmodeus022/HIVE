<?php
session_start();
ob_start();

// Establish database connection
require_once("../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_SESSION['email'];
    $otp = $_POST["code"];

    // Retrieve the stored OTP from the database
    $sql = "SELECT OTP FROM owners WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $storedOTP = $row["OTP"];

    if(isset($_POST['submit'])){
        $otp = $_POST["code"];
    }

    if ($otp == $storedOTP) {
        // OTP verification successful
        // Proceed with password change
        $sql = "UPDATE owners SET OTP = '0' WHERE Email = '$email'";
        mysqli_query($conn, $sql);
        echo"<script>alert('The OTP verification is successfully')</script>";
        header("Location: change_pass.php");

    } else {
        // OTP verification failed
        echo "Invalid OTP. Please try again.";
    }
}

mysqli_close($conn);
?>

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
                <div style="height: 40px">
                    <h5 class="logotype p-0 pt-3 m-0 me-3  fw-bold d-flex justify-content-end">GO BACK</h5>
                </div>
                <div class="h-100 w-100 d-flex justify-content-center align-items-center">
                    <div class="w-100" style="max-width: 80%">
                        <h2 class="title">Verification</h2>
                        <p class="subtitle mb-5">Verify your account</p>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="code" class="form-label fw-bold">Verification code</label>
                                <input type="password" class="form-control" name="code" id="code" required>
                            </div>

                            <div class="d-flex justify-content-end my-5">
                                <button class="btn btn-hive mb-5" type="submit" name="nxtbtn">Submit Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>