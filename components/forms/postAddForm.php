
<?php
    session_start();
    require_once("../../includes/database.php");
    $username = $_SESSION["username"];

    if ( isset($_POST['postBtn'])) {
        // Check if a file is uploaded
        if(isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
            // File upload directory
            $targetDirectory = "./../../includes/phpupload/uploads/";
            // File name
            $targetFile = basename($_FILES["post_image"]["name"]);
            $pathDirectory = $targetDirectory . basename($_FILES["post_image"]["name"]);
            // Attempt to move the file
            if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $pathDirectory)) {
                echo "File uploaded Successfully";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Retrieve form data
        $title = $_POST["title"];
        $content = $_POST["content"];
        $location = $_POST["location"];
        $date = $_POST["date"];
        $filePath = isset($targetFile) ? $targetFile : null; // File path

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO newsfeed (title ,content ,`location`,`date`,file_path,username)
                                VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $title, $content, $location, $date, $filePath, $username);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../../page/soc_med.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
        // Close the connection
        $conn->close();
    }
?>
