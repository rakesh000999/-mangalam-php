<?php
include 'connection.php';
include 'navbar.php';

$user_id = $_SESSION['user_id'];

// this because initially the user_profiles is null and inner join is not applicable
$selectUser = "SELECT * FROM USERS WHERE user_id = $user_id";
$selectUserResult = mysqli_query($conn, $selectUser);

$user = mysqli_fetch_assoc($selectUserResult);

$selectUserInfo = "SELECT username, bio, gender, date_of_birth, location FROM users u INNER JOIN user_profiles p ON u.user_id = p.user_id WHERE u.user_id = $user_id";
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

    $image = $_FILES['profile'];

    $image_name = $image['name'];

    echo $image_name;

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
?>


<div class="row container-lg">
    <div class="col-lg-5 col-md-4">
        <img src="https://avatars.githubusercontent.com/u/154825017?v=4" alt="profile-image" class="rounded">

        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label fw-bold my-2" for="profile">Change Profile Picture</label>
                <input type="file" class="form-control" id="profile" name="profile">
            </div>
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