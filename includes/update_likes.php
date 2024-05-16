<?php
@include "database.php";

if (isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);

    // Update the likes count
    $query = "UPDATE newsfeed SET likes = likes + 1 WHERE id = $post_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the updated likes count
        $query = "SELECT likes FROM newsfeed WHERE id = $post_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(array('likes' => $row['likes']));
        } else {
            echo json_encode(array('error' => 'Failed to fetch likes.'));
        }
    } else {
        echo json_encode(array('error' => 'Failed to update likes.'));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'Invalid request.'));
}
?>
