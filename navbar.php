<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
?>

<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-sm navbar-light bg-light shadow mb-4">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="body.php">Mangalam</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <form class="d-flex my-2 my-lg-0 me-auto">
                <input
                    class="form-control me-sm-2"
                    type="text"
                    placeholder="Search" />
                <button
                    class="btn btn-outline-success my-2 my-sm-0"
                    type="submit">
                    Search
                </button>
            </form>

            <ul class="navbar-nav ms-auto gap-lg-5">
                <div class="d-flex justify-content-between align-items-center gap-5">
                    <div>
                        <button class="rounded bg-success border-0 px-2 py-1"><a href="write.php" class="text-light text-decoration-none">Write✍️</a></button>
                    </div>
                    <div class="">
                        🔔
                    </div>
                </div>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="dropdownMenuLink"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                            alt=""
                            class="image">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>