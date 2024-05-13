<?php
    session_start();
    @include "./cross_access.php";
    @include "../includes/database.php";
    @include "../includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row p-0 m-0" style="height: 100vh; overflow: hidden">
        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row">
                <div class="row">
                <h3 class=" mb-4">Inventory</h3>
                </div>
                <?php
                $sql = "SELECT * FROM owners";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Display owner details
                        $companyName= $row["Company_Name"];
                        $ownerId=$row["Id"];
                        $ownerName=$row["Username"];
                        $category=$row["Category"];
                        $location =$row["Location"];
                        $size=$row["Business_Size"];
                        $email=$row["Email"];
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card border border-dark border-1">
                            <div class="card-header" style="background-color: #A532FF;">
                            <h5 class="card-title"><?php echo $companyName; ?></h5>
                            </div>
                                <div class="card-body"> 
                                    <!-- <h6 class="card-subtitle mb-2 text-muted">Owner ID: <?php echo $ownerId; ?></h6> -->
                                    <p class="card-text">Owner Name: <?php echo $ownerName; ?></p>
                                    <p class="card-text">Business Category: <?php echo $category; ?></p>
                                    <p class="card-text">Business Size: <?php echo $size; ?></p>
                                    <p class="card-text">Location: <?php echo $location; ?></p>
                                </div>
                                <div class="card-footer" style="background-color: #A532FF;">
                                <p class="card-text">Contact Us: <?php echo $email; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results"; 
                }
                $conn->close();
                ?>
        </div>
    </div>
</body>
</html>
