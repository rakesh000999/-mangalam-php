<?php
include 'connection.php';
include 'navbar.php';

$user_id = $_GET['user_id'];

$fetchSql = "SELECT * FROM users u 
                    INNER JOIN user_profiles up 
                    ON u.user_id = up.user_id 
                    WHERE u.user_id = $user_id";

$fetchResult = mysqli_query($conn, $fetchSql);

$result = mysqli_fetch_assoc($fetchResult);

$fetchPosts = "SELECT * FROM posts p INNER JOIN users u ON p.user_id = u.user_id WHERE p.user_id = $user_id ORDER BY p.created_at DESC";
$fetchPostsResult = mysqli_query($conn, $fetchPosts);

?>

<div class="container d-flex">
    <div class="w-75 p-3">
        <p class="h1 mb-5"><?php echo $result['username']; ?></p>
        <hr>
        <div class="w-75">
            <?php
            while ($postResult = mysqli_fetch_assoc($fetchPostsResult)) {
                ?>
                <div class="card d-flex m-2 p-2">
                    <a href="read-blog.php?id=<?php echo $postResult['post_id'] ?>" class="text-decoration-none text-dark">
                        <div>
                            <img src="uploads/<?php echo !empty($result['profile_picture']) ? $result['profile_picture'] : 'default.png'; ?>"
                                alt="profile-image" class='image rounded-circle'
                                style="width: 32px; height: 32px; object-fit: cover;">

                            <span class="text-dark fw-bold"><?php echo $postResult['username'] ?></span>
                        </div>
                        <div class="d-flex">
                            <div class="w-75">
                                <h2><?php echo $postResult['title'] ?></h2>
                                <h4><?php echo $postResult['excerpt'] ?></h4>
                            </div>
                            <div class="w-25 object-fit-fill">

                                <img src="uploads/<?php echo $postResult['blog_image'] ?>" alt="post_image" class=' w-100'>

                            </div>
                        </div>
                        <div class="d-flex gap-4">
                            <div><?php echo $postResult['created_at'] ?></div>

                            <?php
                            $commentCount = "SELECT COUNT(*) as total FROM comments WHERE post_id = " . $postResult['post_id'];
                            $commentCountResult = mysqli_query($conn, $commentCount);
                            $commentCountData = mysqli_fetch_assoc($commentCountResult);
                            $commentCount = $commentCountData['total'];
                            ?>

                            <div><i class="fa-solid fa-heart"></i> 0</div>
                            <div><i class="fa-solid fa-comment"></i> <?php echo $commentCount ?></div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>

        </div>

    </div>

    <div class="border-start w-25 p-3">

        <img src="uploads/<?php echo !empty($result['profile_picture']) ? $result['profile_picture'] : 'default.png'; ?>"
            alt="profile-image" class='rounded w-50'>

        <p class="h1"><?php echo $result['username']; ?></p>
        <p>1 Follower</p>
        <?php
        if ($_SESSION['user_id'] == $user_id) {
            ?>
            <a href="edit-profile.php">Edit profile</a>
            <?php
        }
        ?>

        <p class=""><span class="fw-bold">Bio: </span><?php echo $result['bio']; ?></p>
        <p class=""><span class="fw-bold">Gender: </span><?php echo $result['gender']; ?></p>
        <p class=""><span class="fw-bold"> Gender: </span><?php echo $result['date_of_birth']; ?></p>
        <p class=""><span class="fw-bold">Address: </span><?php echo $result['location']; ?></p>

    </div>
</div>