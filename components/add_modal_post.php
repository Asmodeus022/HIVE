<?php
session_start();
date_default_timezone_set('Asia/Manila');
$d = date("M-d-Y");
$location = $_SESSION['location'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .file-upload {
            height: 100%;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="modal fade" id="staticBackdropAddPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Post</h1>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../components/forms/postAddForm.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-5">
                            <input type="file" class="form-control file-upload" name="post_image" id="post_image" accept="image/*">
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="" required>
                            </div>
                            <div id="error-pName-message" style="color: red;"></div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <input type="text" class="form-control" name="content" id="content" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="location" value="<?php echo $location?>" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control disable" name="date" id="date" value="<?php echo $d?>" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="postBtn">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
