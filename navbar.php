<?php
require 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}

$searchText = '';
if (isset($_POST['search'])) {
    $searchText = $_POST['search-text'];
}

$sql = "SELECT profile_picture FROM user_profiles WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/7419fa8a42.js" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm navbar-light bg-light shadow mb-4">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="index.php">Mangalam</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <form class="d-flex my-2 my-lg-0 me-auto" action="search.php?search=<?php echo $searchText ?>"
                method=" POST">
                <input class="form-control me-sm-2" type="text" name="search-text" id="search"
                    placeholder="Search..." />

                <input type="submit" name="submit" value="Search" class="btn btn-outline-success my-2 my-sm-0">

            </form>

            <ul class="navbar-nav ms-auto gap-lg-5">
                <div class="d-flex justify-content-between align-items-center gap-5">
                    <div>
                        <button class="rounded border-0 px-2 py-1"><a href="write.php"
                                class="text-dark text-decoration-none"><i class="fa-regular fa-pen-to-square"></i> Write
                            </a></button>
                    </div>
                    <div class="">
                        <a href="notification.php" class="text-decoration-none text-dark">
                            <span class="bg-success text-white p-1 " style="
                                width: 30px; /* Adjust size as needed */
                                height: 30px; 
                                border-radius: 50%;
                                display: inline-flex;
                                justify-content: center;
                                align-items: center;
                            ">
                                0
                            </span>
                            <i class="fa-regular fa-bell"></i>
                        </a>
                    </div>
                </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (!empty($row['profile_picture'])) {
                            ?>
                            <img src="uploads/<?php echo $row['profile_picture']; ?>" alt="profile"
                                class="image rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                            <?php
                        } else {
                            ?>
                            <img src="uploads/default.png" alt="profile" class="image rounded-circle">
                            <?php
                        }
                        ?>
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

<!-- ajax search -->
<div id="search-result" class=""></div>

<script>
    document.getElementById('search').addEventListener('input', () => {
        const searchText = document.getElementById('search').value;

        if (searchText.trim().length !== 0) {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("search-result").innerHTML = this.responseText;
                }
            }

            xmlhttp.open("GET", "search-suggestions.php?search-text=" + searchText, true);
            xmlhttp.send();
        } else {
            document.getElementById("search-result").innerHTML = "";
        }
    });
</script>