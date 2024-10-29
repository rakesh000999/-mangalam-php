<?php
include 'connection.php';
session_start();

// check if user is already logged in ( using session)
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

// check if user is already logged in ( using cookie)
// if (isset($_COOKIE['name'])) {
//     header('Location: welcome.php');
// }

$isValid = true;
$errors = array();

$email = $password = '';
$emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$nameError = $emailError = $phoneError = $passwordError = $facultyError = $genderError = "";

if (isset($_POST['login'])) {

    //email
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

    if ($isValid) {
        $password = md5($password);
        $selectSql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $selectResult = mysqli_query($conn, $selectSql);

        if (mysqli_num_rows($selectResult) == 1) {
            $user = mysqli_fetch_assoc($selectResult);

            // store user data in session variable
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // set user data in cookie
            // $expiry = time() + (86400 * 30); //cookie expires in 30 days
            // setcookie('name', $user['name'], $expiry);

            header('Location:index.php');
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show container my-2" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Login Failed!</strong>
            </div>
            <?php
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
    <script src="bootstrap.bundle.min.js"></script>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body style="background-image:url(login.avif); background-size: cover;">
    <div class="container d-flex justify-content-center align-items-center min-vh-100 ">
        <div style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4 fw-bolder fs-1">Login</h3>

            <form action="#" method="POST">

                <!-- <div class="d-flex gap-2 bg-white align-items-center rounded px-2 py-1"> -->
                <div class="form-group">
                    <div class="d-flex gap-2 bg-white align-items-center rounded">
                        <div class="text-dark px-1">👤</div>
                        <input type="email" name="email" id="email" class="form-control border-0"
                            style="outline: 0; border-top-right-radius: 6px; border-bottom-right-radius: 6px;"
                            placeholder="Enter your email">
                    </div>
                    <span class="error fw-bold"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    <br>
                </div>

                <div class="form-group">
                    <div class="d-flex gap-2 bg-white align-items-center rounded">
                        <div class="text-dark px-1">🔐</div>
                        <input type="password" name="password" id="password" class="form-control border-0"
                            style="outline: 0; border-top-right-radius: 6px; border-bottom-right-radius: 6px;"
                            placeholder="Enter your passowrd">
                    </div>
                    <span class="error fw-bold">
                        <?php echo isset($errors['password']) ? $errors['password'] : ''; ?>
                    </span>
                    <br>
                </div>

                <div class="form-group">
                    <input type="submit" name="login" class="btn btn-primary w-100">
                </div>
                <a class="text-white fw-bold" href="./register.php">Not yet registered?</a>
            </form>
        </div>
    </div>

</body>

</html>