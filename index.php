<?php
include 'connection.php';
include 'navbar.php';

$fetchSql = "SELECT p.post_id, u.username, p.title, p.blog_image, p.excerpt, p.created_at, profile_picture
             FROM posts p
             INNER JOIN users u ON u.user_id = p.user_id
             INNER JOIN user_profiles up ON u.user_id = up.user_id
             ORDER BY p.created_at DESC";

$fetchResult = mysqli_query($conn, $fetchSql);

// Fetch comment counts grouped by post_id
$selectComment = "SELECT post_id, COUNT(comment_id) AS comment_count 
                  FROM comments 
                  GROUP BY post_id";
$selectCommentResult = mysqli_query($conn, $selectComment);

// Store comment counts in an associative array
$commentCounts = [];
while ($commentRow = mysqli_fetch_assoc($selectCommentResult)) {
    $commentCounts[$commentRow['post_id']] = $commentRow['comment_count'];
}

?>

<link rel="stylesheet" href="style.css">

<main class="row container-lg mx-auto ">
    <div class="col-lg-8">
        <?php
        while ($result = mysqli_fetch_assoc($fetchResult)) {
            $postId = $result['post_id'];

            // Check if this post has comments, otherwise default to 0
            $commentCount = isset($commentCounts[$postId]) ? $commentCounts[$postId] : 0;
            ?>

            <div class="card d-flex m-2 p-2">
                <div>
                    <img src="uploads/<?php echo !empty($result['profile_picture']) ? $result['profile_picture'] : 'default.png'; ?>"
                        alt="Profile Image" class="image rounded-circle">

                    <span>
                        <a href="viewOthersProfile.php" class="text-decoration-none text-dark">
                            <?php echo $result['username']; ?>
                        </a>
                    </span>
                </div>

                <a href="read-blog.php?id=<?php echo $postId; ?>" class="text-decoration-none text-dark">
                    <div class="d-flex">
                        <div class="w-75">
                            <h2 class="fw-bolder"><?php echo $result['title']; ?></h2>
                            <h4><?php echo $result['excerpt']; ?></h4>
                        </div>
                        <div class="w-25">

                            <img src="uploads/<?php echo $result['blog_image'] ?>" class="rounded w-100 object-fit-cover"
                                alt="blog_image">
                        </div>
                    </div>
                    <div class="d-flex gap-4">
                        <div><?php echo $result['created_at']; ?></div>
                        <div><i class="fa-solid fa-heart"></i> 0</div>
                        <div>
                            <?php echo ($commentCount === 0) ? '' : '<i class="fa-solid fa-comment"></i> ' . $commentCount; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>


    <!-- Top Posts -->
    <?php
    $selectTopComment = $conn->query("
    SELECT p.post_id, u.username, p.title, COUNT(c.comment_id) AS comment_count, profile_picture
    FROM posts AS p
    LEFT JOIN comments AS c ON p.post_id = c.post_id
    LEFT JOIN users AS u ON p.user_id = u.user_id
    LEFT JOIN user_profiles AS up ON u.user_id = up.user_id
    GROUP BY p.post_id, u.username, p.title
    ORDER BY comment_count DESC
    LIMIT 5
");
    ?>

    <div class="col-lg-4">
        <div class="text-success fw-bold h5">Top Posts:</div>
        <?php while ($result = $selectTopComment->fetch_assoc()) {

            ?>
            <a href="read-blog.php?id=<?php echo $result['post_id']; ?>" class="text-decoration-none text-dark">
                <div class="mt-3 card p-2">
                    <div>
                        <!-- <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile Image"
                            class="image"> -->

                        <img src="uploads/<?php echo !empty($result['profile_picture']) ? $result['profile_picture'] : 'default.png'; ?>"
                            alt="Profile Image" class="image rounded-circle">

                        <span class="text-dark fw-bolder"><?php echo $result['username']; ?></span>
                    </div>
                    <p class="h-4"><?php echo $result['title'] ?></p>
                </div>
            </a>
            <?php
        } ?>

    </div>
</main>