<?php
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";
    @include "../components/add_modal_post.php";

    $username_session = $_SESSION["username"];
    $location_session = $_SESSION["location"];

    // Fetch news items from the database in descending order by date
    $query = "SELECT * FROM newsfeed ORDER BY date DESC";
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
        <div class="col">
            <div class="row">
                <div class="profile-pic">
                    <img
                        alt="Profile Picture"
                        src="../assets/images/HIVE SVG BRAND.svg"
                    />
                </div>
                <div class="col">
                    <div class="row w-auto">
                        <button type="button" class="btn border m-3 custom-text-box" data-bs-toggle="modal" data-bs-target="#staticBackdropAddPost">Share a Story...</button>
                    </div>
                </div>
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
                                        <!-- Like Button -->
                                        <button class="like-button" data-post-id="<?php echo $newsItem['id']; ?>">
                                            <img src="../assets/images/thumb_up.svg" alt="Thumb Up Icon">
                                        </button>
                                        <span class="likes-count ms-1"><?php echo $newsItem['likes']; ?> likes</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
$(document).ready(function() {
    $('.like-button').on('click', function() {
        var button = $(this);
        var postId = button.data('post-id');
        $.ajax({
            url: '../includes/update_likes.php',
            type: 'POST',
            data: { post_id: postId },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.likes) {
                    button.next('.likes-count').text(data.likes + ' likes');
                } else if (data.error) {
                    console.error(data.error);
                }
            },
            error: function() {
                console.error('Error updating likes');
            }
        });
    });
});
</script>
</body>
</html>
