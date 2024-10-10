<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
?>

<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

<nav class="d-flex justify-content-between align-items-center mx-5 mt-3">
    <div class="d-flex gap-5 align-items-center">
        <div>
            <h3 class="text-info-emphasis font-monospace p-0"><a href="body.php" class="fw-bolder text-decoration-none">Mangalam</a></h3>
        </div>
        <div>
            <input class="rounded-5 p-1 px-3" type="search" placeholder="Search...">
            <button class="rounded-3">Search</button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center gap-5">
        <div>
            <button class="rounded bg-success border-0 px-2 py-1"><a href="write.php" class="text-light text-decoration-none">Write✍️</a></button>
        </div>
        <div>
            🔔
        </div>
        <div>
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" class="image">
        </div>

    </div>
</nav>
<hr>

<div class="position-absolute end-0 d-flex flex-column gap-1 rounded p-2 border border-1 bg-light profile-container">
    <a href="profile.php" class="text-dark p-2 text-decoration-none rounded ">
        Profile
    </a>
    <a href="logout.php" class="text-black p-2 text-decoration-none rounded text-end ">
        Logout
    </a>
</div>