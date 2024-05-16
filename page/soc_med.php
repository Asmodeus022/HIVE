<?php
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";
    @include "../components/add_modal_post.php";

    $username_session = $_SESSION["username"];
    $location_session = $_SESSION["location"];
     // Fetch news items from the database
     $query = "SELECT * FROM newsfeed";
     $result = mysqli_query($conn, $query);
 
     // Check if query executed successfully
     if (!$result) {
         die("Database query failed.");
     }
 
     // Fetch the data into an array
     $newsData = array();
     while ($row = mysqli_fetch_assoc($result)) {
         $newsData[] = $row;
     }
     // Close the database connection
     mysqli_close($conn);

    $suggestedUsernames = array(
        "Max", "Nekonics", "Paul", "Tyrone", "Sharlyn",
        "Pajeto", "Sera", "Asmodeus", "Amanda", "Arnel"
    );

    $locations = array(
        "Angeles City", "Pandan", "Balibago", "Marisol", "Apalit",
        "Dolores", "Lakandula", "Consuelo", "Maimpis", "Pulung Bulu"
    );

    // Function to get unique random items from an array
    function getUniqueRandomItems($array, $count) {
        if ($count > count($array)) {
            $count = count($array);
        }
        $randomKeys = array_rand($array, $count);
        $randomItems = array();
        foreach ((array) $randomKeys as $key) {
            $randomItems[] = $array[$key];
        }
        return $randomItems;
    }

    // Get four unique random usernames
    $uniqueRandomUsernames = getUniqueRandomItems($suggestedUsernames, 4);

    // Get four unique random locations
    $uniqueRandomLocations = getUniqueRandomItems($locations, 4);

    // Add a random number of likes to each news item
    foreach ($newsData as &$newsItem) {
        $newsItem['likes'] = rand(1, 100); // Random number between 1 and 100
    }
    unset($newsItem); // Break the reference with the last element
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/soc_med.css">
</head>
<body>
    <div class="row p-0 m-0" style="height: 100vh;">
        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="profile-pic">
                    <img
                        alt="Profile Picture"
                        src="../assets/images/HIVE SVG BRAND.svg"
                    />
                </div>
                <button type="button" class="btn border m-3 custom-text-box" data-bs-toggle="modal" data-bs-target="#staticBackdropAddPost">Share a Story...</button>
            </div>
            <div class="container-fluid scrollable-container" style="height: calc(100vh - 80px); overflow-y: auto;">
                <div class="row">
                    <div class="col">
                        <?php foreach ($newsData as $newsItem) { ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <img class="profile-pic-card me-3" alt="Profile Picture" src="../assets/images/HIVE SVG BRAND.svg">
                                        <div>
                                            <h5 class="mb-0"><?php echo $newsItem['title']; ?></h5>
                                            <p class="mb-0"><?php echo $newsItem['location']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php $imagePath = '../includes/phpupload/uploads/' . $newsItem['file_path']; ?>
                                    <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="..." style="width: 500px">
                                    <p class="card-text"><?php echo $newsItem['content']; ?></p>
                                </div>
                                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                    <span><?php echo $newsItem['date']; ?></span>
                                    <div>
                                        <!-- Heart Icon -->
                                        <img class="" src="../assets/images/heart.svg">
                                        <!-- Email Icon -->
                                        <img class="" src="../assets/images/mail.svg">
                                        <!-- Star Icon -->
                                        <img class="" src="../assets/images/star.svg">
                                        <!-- Likes Count -->
                                        <img class="" src="../assets/images/thumb_up.svg">
                                        <span class="ms-1"><?php echo $newsItem['likes']; ?> likes</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="position-absolute top-0 end-2 p-3" style="padding-top: 0px;">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg">
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-1"><?php echo $username_session?></p>
                        <p class="text-muted mb-0"><?php echo $location_session?></p>
                    </div>
                </div>
                <h4>Suggested for you</h4>
                <div class="row align-items-center">
                    <?php 
                    for ($i = 0; $i < count($uniqueRandomUsernames); $i++) { ?>
                        <div class="row align-items-center mb-1">
                            <div class="col-auto">
                                <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg" alt="Profile Picture">
                            </div>
                            <div class="col">
                                <p class="fw-bold mb-0"><?php echo $uniqueRandomUsernames[$i]; ?></p>
                                <p class="text-muted mb-0"><?php echo $uniqueRandomLocations[$i]; ?></p>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-hive">Follow</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="my-3"><small>About • Help • Jobs • Privacy • Terms • Locations</small></div>
                <small>@ 2024 Hive</small>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>
