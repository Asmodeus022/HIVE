<?php
function checkIfExist($email, $conn){
    $sqls =  "SELECT email FROM managers WHERE email='$email' LIMIT 1";
    $results = $conn->query($sqls);
    if($results){
        $rowss = $results->fetch_assoc();
        if($rowss){
            return true;
        }else{
           return false;
        }
    }
}

function register($companyname, $location, $businesscategory, $businesssize, $email, $pword, $conn){
    $exist = checkIfExist($email, $conn);
    if($exist){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Existing user,</strong>Your preferred username is not available!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }else{
        $otp='0';
        $hashpass=md5($pword);
        $sql = ("INSERT INTO managers(company_name, `location`,business_category, business_size,email, pword , otp) VALUES('$companyname','$location','$businesscategory','$businesssize','$email','$hashpass','$otp')");
        $result = $conn->query($sql);
        if($result === TRUE){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success! </strong>Registration successful!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        header("Location: login.php");
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error! </strong>Registration failed: " . $conn->error . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }

    }
}

session_start();
ob_start();
require_once('../includes/database.php');

if(isset($_POST['btnenter'])){
    register($_POST['company_name'], $_POST['location'], $_POST['business_category'], $_POST['business_size'],$_POST['email'],$_POST['pword'], $conn);
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
        <link rel="stylesheet" href="../assets/css/registration_page.css">
        
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
                    <h5 class="logotype p-0 pt-3 m-0 me-3 fw-bold d-flex justify-content-end">GO BACK</h5>
                </div>
                <div class="h-100 w-100 d-flex justify-content-center align-items-center">
                    <div class="w-100 mb-5" style="max-width: 80%">
                        <h2 class="title">Welcome to the Hives!</h2>
                        <p class="subtitle">Please create a profile</p>
                        <form action="regverification_page.php" method="POST">
                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="profile-pic">
                                <img
                                    alt="Profile Picture"
                                    src="../assets/images/HIVE SVG BRAND.svg"
                                />
                                </div>   
                            </div>
                            <div class="mb-2 mt-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" aria-describedby="profileNameHelp">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-2">
                                <label for="pword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="pword" id="pword">
                            </div>
                            <div class="mb-2">
                                <label for="pword" class="form-label">Location</label>
                                <select name="location" class="form-select" aria-label="Default select example">
                                    <option selected>Select your location</option>
                                    <option value="Anunas">Anunas</option>
                                    <option value="Balibago">Balibago</option>
                                    <option value="Capaya">Capaya</option>
                                    <option value="Claro M. Recto">Claro M. Recto</option>
                                    <option value="Claro M. Recto (Pob.)">Claro M. Recto (Pob.)</option>
                                    <option value="Cuayan">Cuayan</option>
                                    <option value="Cutcut">Cutcut</option>
                                    <option value="Cutud">Cutud</option>
                                    <option value="Lourdes North West">Lourdes North West</option>
                                    <option value="Lourdes Sur">Lourdes Sur</option>
                                    <option value="Lourdes Sur East">Lourdes Sur East</option>
                                    <option value="Malabanias">Malabanias</option>
                                    <option value="Margot">Margot</option>
                                    <option value="Marisol">Marisol</option>
                                    <option value="Mining">Mining</option>
                                    <option value="Ninoy Aquino (Marisol)">Ninoy Aquino (Marisol)</option>
                                    <option value="Pampang">Pampang</option>
                                    <option value="Pandan">Pandan</option>
                                    <option value="Pulungbulu">Pulungbulu</option>
                                    <option value="Pulung Cacutud">Pulung Cacutud</option>
                                    <option value="Salapungan">Salapungan</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="San Nicolas">San Nicolas</option>
                                    <option value="Santa Teresita">Santa Teresita</option>
                                    <option value="Santo Cristo">Santo Cristo</option>
                                    <option value="Santo Domingo">Santo Domingo</option>
                                    <option value="Santo Rosario (Pob.)">Santo Rosario (Pob.)</option>
                                    <option value="Santo Tomas">Santo Tomas</option>
                                    <option value="Sapalibutad">Sapalibutad</option>
                                    <option value="Sapangbato">Sapangbato</option>
                                    <option value="Tabun">Tabun</option>
                                    <option value="Virgen Delos Remedios">Virgen Delos Remedios</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="pword" class="form-label">Business Category</label>
                                <select name="business_category" class="form-select" aria-label="Default select example">
                                    <option selected>Select your business category</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Beauty and Personal Care">Beauty and Personal Care</option>
                                    <option value="Craft and Hobby">Craft and Hobby</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Food and Beverage">Food and Beverage</option>
                                    <option value="General Store">General Store</option>
                                    <option value="Gifts and Novelties">Gifts and Novelties</option>
                                    <option value="Health and Wellness">Health and Wellness</option>
                                    <option value="Pet Supplies">Pet Supplies</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Specialty Stores">Specialty Stores</option>
                                    <option value="Sports and Outdoor">Sports and Outdoor</option>
                                    <option value="Technology">Technology</option>
                                </select>    
                            </div>
                            <div class="mb-3">
                                <label for="pword" class="form-label">Business Size</label>
                                <select name="business_size" class="form-select" aria-label="Default select example">
                                    <option selected>Select your business size</option>
                                    <option value="Micro">Micro (1 - 9 employees)</option>
                                    <option value="Small">Small (10 - 99 employees)</option>
                                    <option value="Medium">Medium (100 - 199 employees)</option>
                                    <option value="Large">Large (>200 employees)</option>
                                </select>  
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-hive" type="submit" name="btnenter">Proceed to next step</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>