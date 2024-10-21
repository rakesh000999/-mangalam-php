<?php
include 'connection.php';
include 'navbar.php';

// Fetch posts along with user information
$fetchSql = "SELECT post_id, username, title, content, created_at 
             FROM users 
             INNER JOIN posts ON users.user_id = posts.user_id
             ORDER BY created_at DESC";
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
    <div class="border-end col-lg-8">
        <?php
        while ($result = mysqli_fetch_assoc($fetchResult)) {
            $postId = $result['post_id'];
            // Check if this post has comments, otherwise default to 0
            $commentCount = isset($commentCounts[$postId]) ? $commentCounts[$postId] : 0;
        ?>
            <div class="card d-flex m-2 p-2">
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        alt="Profile Image" class="image">
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
                            <h4><?php echo $result['content']; ?></h4>
                        </div>
                        <div class="w-25 object-fit-fill">
                            <img src="https://i0.wp.com/picjumbo.com/wp-content/uploads/beautiful-beach-free-image-after-sunset-sky-free-photo.jpeg?w=600&quality=80"
                                alt="Blog Image" class="w-100">
                        </div>
                    </div>
                    <div class="d-flex gap-4">
                        <div><?php echo $result['created_at']; ?></div>
                        <div>👍 0</div>
                        <div><?php echo ($commentCount === 0) ? '' : "💬" . $commentCount; ?></div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="col-lg-4">
        <?php foreach (range(1, 5) as $i) { ?>
            <div>
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        alt="Profile Image" class="image">
                    <span>Rakesh Joshi</span>
                </div>
                <p class="h-4">Lorem ipsum dolor sit amet consectetur.</p>
            </div>
        <?php } ?>
    </div>
</main>