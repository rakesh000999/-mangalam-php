<?php
require '../connection.php';

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {

    $newPassword = md5($_POST['newPassword']);

    $updatePassword = "UPDATE users SET password = '$newPassword' WHERE user_id = $user_id";
    $updatePasswordResult = mysqli_query($conn, $updatePassword);

    if ($updatePasswordResult) {
        header('Location: ../login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <script src="../bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav class="py-3 shadow">
        <h2 class="px-3">Mangalam</h2>
    </nav>

    <div class="card my-5 container" style="max-width: 500px;">
        <div class="card-body">
            <h4 class="card-title">Reset your password</h4>
            <p class="text-muted">
                Enter a new password for your account.
            </p>
            <hr>
            <form action="#" method="POST" class="mt-3">
                <!-- New Password Field -->
                <div class="form-group mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                        placeholder="Enter new password" required>
                </div>
                <!-- Confirm Password Field -->
                <div class="form-group mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                        placeholder="Re-enter new password" required>
                </div>
                <!-- Submit Button -->
                <input type="submit" name="submit" class="btn btn-primary w-100">
            </form>
        </div>
    </div>

</body>

</html>