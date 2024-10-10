<?php

include 'connection.php';

$isValid = true;
$errors = array();

$username = $email  = $password  = $cPassword = '';
$emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$usernameError = $emailError =  $passwordError = $cPasswordError = "";

$selectSql = "SELECT username, email FROM users";
$selectResult = mysqli_query($conn, $selectSql);

$row = mysqli_num_rows($selectResult);

function isUserRegistered($row)
{
    if ($row === 1) {
?>
        <div
            class="alert alert-info alert-dismissible fade show"
            role="alert">
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>
            <strong>User is already registered!</strong>
        </div>
<?php
    }
}

if (isset($_POST['submit'])) {

    // username
    isUserRegistered($row);
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username']) != '') {
        $username = $_POST['username'];
    } else {
        $errors['username'] = "First name is not valid! <br>";
        $isValid = false;
    }

    // email
    isUserRegistered($row);
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email']) != '') {
        $email = $_POST['email'];
        if (!preg_match($emailPattern, $email)) {
            $errors['email'] = "Email must be in the proper format!";
            $isValid = false;
        }
    } else {
        $isValid = false;
        $errors['email'] = "Email is not valid! <br>";
    }


    // password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $isValid = false;
        $errors['password'] = "Password is required! <br>";
    }

    $cPassword = $_POST['c-password'];
    if ($password !== $cPassword) {
        $isValid = false;
        $errors['cPassword'] =  "Password must match! <br>";
    }

    // database insertion
    if ($isValid) {
        $password = md5($password);
        $insertQuery = "INSERT INTO users (username, email, password ) VALUES ('$username','$email','$password')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            header('Location: login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangalam</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        span {
            color: red;
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid lightskyblue;
        }
    </style>
</head>

<body>

    <div class="container mx-auto">
        <h1 class="font-bold text-success text-center">Sign Up</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control">
                <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span>
                <br>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                <br>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
                <br>
            </div>

            <div class="form-group">
                <label for="c-password" class="form-label">Confirm Password</label>
                <input type="password" name="c-password" id="c-password" class="form-control">
                <span class="error"><?php echo isset($errors['cPassword']) ? $errors['cPassword'] : ''; ?></span>
                <br>
            </div>

            <div class="my-3">
                <input type="submit" name="submit" class="btn btn-primary">
                <input type="reset" name="reset" class="btn btn-danger">
            </div>

            <a href="./login.php">Already Registered?</a>
        </form>
    </div>
</body>

</html>