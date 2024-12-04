<?php

require '../connection.php';

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
} else {
    $email = $_SESSION['email'];
}

$code = $_SESSION['code'];

if (isset($_POST['submit'])) {
    $user_code = $_POST['code'];

    $selectCode = "SELECT * FROM password_resets WHERE otp = '$user_code'";
    $selectCodeResult = mysqli_query($conn, $selectCode);

    $result = mysqli_fetch_assoc($selectCodeResult);

    if ($result['otp'] === $code) {
        header('location:password-reset-page.php');
    } else {
        header('location:index.php');
    }
}

?>

<link rel="stylesheet" href="../bootstrap.min.css">
<script src="../bootstrap.bundle.min.js"></script>

<!-- <body class="bg-secondary bg-gradient  "> -->

<nav class="py-3 shadow">
    <h2 class="px-3">Mangalam</h2>
</nav>

<div class="card my-5 container" style="max-width: 550px;">
    <div class="card-body">
        <h4 class="card-title">Enter security code</h4>
        <hr>
        <p class="text-black">Please check your email for a message with your code. Your code is 6 numbers long.</p>

        <form action="#" method="POST" class="mt-3">
            <div class="form-group d-flex gap-3 align-items-center">
                <div>
                    <input type="text" class="form-control py-3" id="emailCode" name="code"
                        placeholder="Enter 6-digit code">
                </div>
                <div>
                    <p class="mt-2">We sent your code to:</p>
                    <p> <strong><?php echo $email ?></strong></p>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-secondary">Cancel</button>
                <input type="submit" name="submit" class="btn btn-primary fw-bold" value="Continue">
            </div>
        </form>

    </div>
</div>
<!-- </body> -->