<?php
include 'connection.php';
include 'navbar.php';

$user_id = $_SESSION['user_id'];

// this because initially the user_profiles is null and inner join is not applicable
$selectUser = "SELECT * FROM USERS WHERE user_id = $user_id";
$selectUserResult = mysqli_query($conn, $selectUser);

$user = mysqli_fetch_assoc($selectUserResult);

$selectUserInfo = "SELECT username, bio, profile_picture, gender, date_of_birth, location FROM users u INNER JOIN user_profiles p ON u.user_id = p.user_id WHERE u.user_id = $user_id";
$selectUserInfoResult = mysqli_query($conn, $selectUserInfo);

$userInfo = mysqli_fetch_assoc($selectUserInfoResult);

$isValid = true;
$errors = [];

if (isset($_POST['update'])) {
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username']) != '') {
        $username = $_POST['username'];
    } else {
        $errors['username'] = "Username is required! <br>";
        $isValid = false;
    }

    if (isset($_POST['bio']) && !empty($_POST['bio']) && trim($_POST['bio']) != '') {
        $bio = $_POST['bio'];
    } else {
        $errors['bio'] = "Bio is required! <br>";
        $isValid = false;
    }

    if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender']) != '') {
        $gender = $_POST['gender'];
    } else {
        $errors['gender'] = "Gender is required! <br>";
        $isValid = false;
    }

    if (isset($_POST['dob']) && !empty($_POST['dob']) && trim($_POST['dob']) != '') {
        $dob = $_POST['dob'];
    } else {
        $errors['dob'] = "DOB is required! <br>";
        $isValid = false;
    }

    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address']) != '') {
        $address = $_POST['address'];
    } else {
        $errors['address'] = "Address is required! <br>";
        $isValid = false;
    }




    if ($isValid) {
        $updateUsername = "UPDATE users SET username = '$username' WHERE user_id = $user_id";
        $updateUsernameResult = mysqli_query($conn, $updateUsername);

        $selectUserDetail = "SELECT * FROM user_profiles WHERE user_id = $user_id";
        $selectUserDetailResult = mysqli_query($conn, $selectUserDetail);

        $userData = mysqli_num_rows($selectUserDetailResult);

        if ($userData === 1) {
            $updateProfileDetails = "UPDATE user_profiles SET bio = '$bio', gender = '$gender' , location = '$address' WHERE user_id = $user_id";

            $updateProfileDetailResult = mysqli_query($conn, $updateProfileDetails);
        } else {
            $insertProfileDetails = "INSERT INTO user_profiles (user_id, bio, gender, date_of_birth, location) VALUES ( $user_id, '$bio', '$gender', '$dob', '$address')";

            $insertProfileDetailsResult = mysqli_query($conn, $insertProfileDetails);
        }
    }
}

if (isset($_POST['addprofile'])) {

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

}
?>


<div class="row container-lg d-flex justify-content-center">
    <div class="col-lg-5 col-md-4">

        <img src="uploads/<?php echo !empty($userInfo['profile_picture']) ? $userInfo['profile_picture'] : 'default.png'; ?>"
            alt="profile-image" class='rounded w-50'>

        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label fw-bold my-2" for="profile">Change Profile Picture</label>
                <input type="file" class="form-control" id="profile" name="profile">
            </div>
            <input type="submit" name="addprofile" value="Add"
                class="bg-primary border-0 text-white px-2 py-1 my-1 rounded">
        </form>
    </div>

    <div class="col-lg-7">
        <form action="#" method="post">
            <div class="form-group">
                <label for="username" class="form-label h4">Username</label>
                <input type="text" name="username" id="username" class="form-control"
                    value="<?php echo $user['username'] ?>">
                <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="" class="form-label h4">Bio</label>
                <textarea id="" name="bio" class="form-control" rows="10"><?php if (!empty($userInfo))
                    echo $userInfo['bio']; ?></textarea>
                <span class="error"><?php echo isset($errors['bio']) ? $errors['bio'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="gender" class="h4 w-100">Gender</label>
                <input type="radio" id="male" value="m" name="gender" class="" <?php if (!empty($userInfo)) if ($userInfo['gender'] == "m")
                    echo "checked" ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" value="f" name="gender" class="" <?php if (!empty($userInfo)) if ($userInfo['gender'] == "f")
                    echo "checked" ?>>
                        <label for="female">Female</label>
                        <input type="radio" id="other" value="o" name="gender" class="" <?php if (!empty($userInfo)) if ($userInfo['gender'] == "o")
                    echo "checked" ?>>
                        <label for="other">Other</label><br>
                        <span class="error"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="dob" class="h4 w-100">DOB</label>
                <input type="date" name="dob" id="dob" value="<?php echo $userInfo['date_of_birth']; ?>"><br>
                <span class="error"><?php echo isset($errors['dob']) ? $errors['dob'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="" class="form-label h4">Address</label>
                <input type="text" class="form-control" name="address" value="<?php if (!empty($userInfo))
                    echo $userInfo['location']; ?>">
                <span class="error"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></span>
            </div>
            <div class="my-2">
                <input type="submit" name="update" value="Save"
                    class="bg-primary border-0 text-white px-2 py-1 rounded">
            </div>
        </form>
    </div>
</div>