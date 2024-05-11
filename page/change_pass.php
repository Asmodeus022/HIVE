<?php
  session_start();
  ob_start();
  function changePass($email, $newPass){
    require_once("../includes/database.php");
      //prepare and execute the sql statement to update the password
      $stmt = $conn->prepare("UPDATE managers SET pword= ? WHERE email= ?");
      $stmt->bind_param("ss", $newPass, $email);
      if($stmt->execute()){
          //IF there is affected row means the update is successful
          if(mysqli_affected_rows($conn) > 0){
            $sqlUpdate="UPDATE managers SET date_modified=NOW()";
            date_default_timezone_set('Asia/Manila');
          } else {
              echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>Warning!</strong> Password update did not take effect.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
          }
      }
      // Close the statement and database connection
      $stmt->close();
      $conn->close();
  }


  if(isset($_POST['submit'])){
    if ($_POST['newPassword'] == $_POST['confirmNewPassword']) {
      changePass($_SESSION['email'], md5($_POST['confirmNewPassword']));
      header("Location: login.php");
    }
    else {
      echo" <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>warning!</strong> Password changed Failed!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}
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
                        <h2 class="title">Change Password</h2>
                        <p class="subtitle mb-5">Change your password</p>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="code" class="form-label fw-bold">New Password</label>
                                <input type="password" class="form-control" name="newPassword" id="code">
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label fw-bold">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirmNewPassword" id="code">
                            </div>
                            <div class="d-flex justify-content-end my-5">
                                <button class="btn btn-hive mb-5" type="submit" name="submit">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>