<?php
    session_start();
    @include "./cross_access.php";
    @include "../includes/database.php";
    @include "../includes/header.php";
?>
<?php
// Example $newsData array structure
$newsData = array(
    array("title" => "Pajeto Corp.", "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "date" => "2024-05-13", "image" => "../assets/images/HIVE SVG BRAND.svg",  "Location" => "Angeles"),
    array("title" => "Tekti", "content" => "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "date" => "2024-05-12", "image" => "../assets/images/HIVE SVG BRAND.svg", "Location" => "Pandan"),
    array("title" => "Padyak Incorp.", "content" => "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "date" => "2024-05-11", "image" => "../assets/images/HIVE SVG BRAND.svg", "Location" => "Marisol"),
    array("title" => "Bikykle", "content" => "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "date" => "2024-03-25", "image" => "../assets/images/HIVE SVG BRAND.svg", "Location" => "Balibago")
);
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
                <input type="text" class="form-control m-3 custom-text-box" id="userTitle" name="userTitle" value="" placeholder="Share a Story...">
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
                                            <p class="mb-0"><?php echo $newsItem['Location']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo $newsItem['image']; ?>" class="card-img-top" alt="...">
                                    <p class="card-text"><?php echo $newsItem['content']; ?></p>
                                </div>
                                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                    <span><?php echo $newsItem['date']; ?></span>
                                    <div>
                                        <!-- Heart Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart me-2" viewBox="0 0 16 16">
                                            <path d="M8 14s-5-3.5-5-7a3.5 3.5 0 0 1 7 0C13 10.5 8 14 8 14z"/>
                                            <path fill-rule="evenodd" d="M13.497 2.246A4.5 4.5 0 0 0 8 4.5a4.5 4.5 0 0 0-5.497-2.254A5.518 5.518 0 0 0 0 7c0 3.681 3.472 6.579 7.755 11.144a.5.5 0 0 0 .49.356c.25 0 .466-.167.49-.405C12.528 13.405 16 10.507 16 7a5.518 5.518 0 0 0-2.503-4.754zM8 14s5-3.5 5-7a3.5 3.5 0 0 0-7 0C3 10.5 8 14 8 14z"/>
                                        </svg>
                                        <!-- Email Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope me-2" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H1.5A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5H1.5z"/>
                                            <path d="M8 6l4 3.5-4 3.5-4-3.5L8 6zm0 1.5L5.5 9 8 10.5 10.5 9 8 7.5z"/>
                                            <path d="M8 6l-4 3.5 4 3.5 4-3.5L8 6zm0 1.5L5.5 9 8 10.5 10.5 9 8 7.5z"/>
                                        </svg>
                                        <!-- Star Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star me-2" viewBox="0 0 16 16">
                                            <path d="M7.332.753a.5.5 0 0 1 .336.048l3.823 1.719 1.036 3.657a.5.5 0 0 1-.131.49l-3.089 2.278 1.136 3.582a.5.5 0 0 1-.773.554L8 12.513l-3.703 2.322a.5.5 0 0 1-.773-.554l1.136-3.582-3.089-2.278a.5.5 0 0 1-.131-.49l1.036-3.657 3.823-1.719a.5.5 0 0 1 .336-.048zM8 11.198l2.238 1.402-.85-2.685 2.248-1.655-2.96-.213-.93-2.803-.93 2.803-2.96.213 2.248 1.655-.85 2.685L8 11.198z"/>
                                        </svg>
                                        <!-- Likes Count -->
                                        <span class="ms-1">10 likes</span>
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
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-muted mb-0">User bio</p>
                    </div>
                </div>
            <h4>Suggest for you</h4>
            <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg">
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-muted mb-0">User bio</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg">
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-muted mb-0">User bio</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg">
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-muted mb-0">User bio</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="profile-pic mb-2" src="../assets/images/HIVE SVG BRAND.svg">
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-muted mb-0">User bio</p>
                    </div>
                </div>
                
            <div class="my-3"><small>About • Help • Jobs • Privacy • Terms • Locations</small></div>
            <small>@ 2024 Hive</small>
        </div>
        </div>
    </div>
</body>
</html>
