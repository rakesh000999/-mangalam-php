<?php
include 'connection.php';
include 'nav.php';

$user_id = $_SESSION['user_id'];

$fetchSql = "SELECT * FROM users WHERE user_id = $user_id";
$fetchResult = mysqli_query($conn, $fetchSql);

$result = mysqli_fetch_assoc($fetchResult);

$fetchPosts = "SELECT * FROM posts p INNER JOIN users u ON p.user_id = u.user_id where p.user_id = $user_id";
$fetchPostsResult = mysqli_query($conn, $fetchPosts);

?>

<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.bundle.min.js"></script>

<div class="container d-flex">
    <div class="w-75 p-3">
        <p class="h1 mb-5"><?php echo $result['username']; ?></p>
        <hr>
        <div class="w-75">
            <?php
            while ($postResult = mysqli_fetch_assoc($fetchPostsResult)) {
            ?>
                <div class="card d-flex m-2 p-2">
                    <a href="read-blog.php?id=<?php echo $postResult['post_id'] ?>"
                        class="text-decoration-none text-dark">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                alt=""
                                class="image">
                            <span><?php echo $postResult['username'] ?></span>
                        </div>
                        <div class="d-flex">
                            <div class="w-75">
                                <h2><?php echo $postResult['title'] ?></h2>
                                <h4><?php echo $postResult['content'] ?></h4>
                            </div>
                            <div class="w-25 object-fit-fill">
                                <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="" class="w-100">
                            </div>
                        </div>
                        <div><?php echo $postResult['created_at'] ?></div>
                    </a>
                </div>
            <?php
            }
            ?>

        </div>

    </div>

    <div class="border-start w-25 p-3">
        <img src="https://avatars.githubusercontent.com/u/154825017?v=4" alt="profile_image" class="w-25 rounded-5">
        <p class="h1"><?php echo $result['username']; ?></p>
        <p>1 Follower</p>
        <a href="#">Edit profile</a>
    </div>
</div>