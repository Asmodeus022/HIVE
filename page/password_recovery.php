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
                    <div class="w-100 mb-5" style="max-width: 80%">
                        <h2 class="title">Password Recovery</h2>
                        <p class="subtitle">Please enter your email</p>
                        <form action="../includes/otp.php" method="POST">
                            <div class="mb-3 mt-5">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="profileNameHelp" require>
                            </div>
                            <div class="d-flex justify-content-end mt-5">
                                <button class="btn btn-hive" type="submit" name="btncode">Send Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>