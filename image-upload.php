<?php

$image = $_FILES['profile'];
$title = $image['name']; //name is pre-defined...

$image_name = $image['name']; //name is pre-defined...
$image_size = $image['size']; // size is pre-defined...

if ($title != "" && $image_name != "") {
    $image_array = explode('.', $image_name);
    $extension = end($image_array);

    if ($extension === 'jpg' || $extension === 'png' || $extension === 'jpeg') {
        if ($image_size === 0) {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    File size exceeds maximum value. Only file less than 2 MB is supported.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } elseif ($image_size > 0 && $image_size < 2097152) {
            $image_final_name = strtolower(str_replace(" ", "", $title) . "-" . time() . "." . $extension);
            // echo $image_final_name;

            if (move_uploaded_file($image['tmp_name'], "uploads/" . $image_final_name)) {
                $insert_query = "UPDATE user_profiles SET profile_picture = '$image_final_name' WHERE user_id = $user_id";
                $insert_result = mysqli_query($conn, $insert_query);

                if ($insert_result) {
                    echo header('refresh: 2, url:index.php');
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Image added successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
            }
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                File type is not supported. Only jpg, png and jpeg is supported!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    } else {
    }
} else {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Field is required!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}