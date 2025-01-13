<?php
include 'connection.php';
include 'navbar.php';

$user_id = $_SESSION['user_id'];

$getBlogId = $_GET['id'];

$fetchSql = "SELECT * FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN categories c ON c.category_id = p.category_id  WHERE post_id = '$getBlogId'";
$fetchResult = mysqli_query($conn, $fetchSql);

$data = mysqli_fetch_assoc($fetchResult);

// COMMENT
$selectUser = "SELECT * FROM users u INNER JOIN user_profiles up ON u.user_id = up.user_id WHERE u.user_id = $user_id";
$selectUserResult = mysqli_query($conn, $selectUser);

$userData = mysqli_fetch_assoc($selectUserResult);

$comment = '';
$error = [];

$isValid = true;

if (isset($_POST['submit'])) {
    if (isset($_POST['comment-text']) && !empty($_POST['comment-text']) && trim($_POST['comment-text'])) {
        $comment = $_POST['comment-text'];
    } else {
        $error['commentError'] = "Field is required!";
        $isValid = false;
    }

    if ($isValid) {
        $insertComment = "INSERT INTO comments (post_id, user_id, comment_text) VALUES ($getBlogId, $user_id, '$comment')";
        $insertCommentResult = mysqli_query($conn, $insertComment);
    }
}

// select comment
$selectComment = "SELECT * FROM comments c 
                        INNER JOIN users u 
                        ON c.user_id = u.user_id 
                        INNER JOIN user_profiles up
                        ON u.user_id = up.user_id
                        WHERE post_id = '$getBlogId'";
$selectCommentResult = mysqli_query($conn, $selectComment);

$row = mysqli_num_rows($selectCommentResult);
?>

<link rel="stylesheet" href="bootstrap.min.css">

<div class="row mx-3">

    <div class="col-12 col-lg-8 mt-4">
        <span class="fw-bold text-success h4">Author: <?php echo $data['username'] ?></span>
        <br>
        <span class="fw-bold text-success h4">Category: <?php echo $data['category_name'] ?></span>
        <p class="h1 fw-bold mt-2"><?php echo $data['title']; ?></p>
        <p class="h4"><?php echo $data['excerpt'] ?></p>
        <img src="uploads/<?php echo $data['blog_image'] ?>" class="rounded mt-5 mb-5" alt="blog_image">
        <p class="h3"><?php echo $data['content']; ?></p>
    </div>

    <div class="col-12 col-lg-4 shadow-lg rounded ">
        <p class="fw-bolder h3 mt-3"><?php echo ($row <= 1) ? "Comment ($row)" : "Comments ($row)"; ?></p>
        <div class="card shadow-sm p-2 mt-3">
            <div>

                <img src="uploads/<?php echo !empty($userData['profile_picture']) ? $userData['profile_picture'] : 'default.png'; ?>"
                    alt="profile-image" class='rounded-circle image'
                    style="width: 32px; height: 32px; object-fit: cover;">



                <span><a href="viewOthersProfile.php"
                        class="text-decoration-none text-dark fw-bold"><?php echo $userData['username'] ?></a></span>
            </div>
            <form action="#" method="post">
                <div class="mt-2">
                    <textarea name="comment-text" id="" rows="2" class="form-control"
                        placeholder="Write comment here!"></textarea>
                    <span><?php echo isset($error['commentError']) ? $error['commentError'] : ''; ?></span>
                </div>
                <div class="mt-2">
                    <input type="submit" class="btn btn-success fw-bolder border-0 px-2 py-1 rounded-1" value="Comment"
                        name="submit">
                </div>
            </form>
        </div>
        <div>
            <hr>
            <div>

                <?php
                while ($commentData = mysqli_fetch_assoc($selectCommentResult)) {
                    ?>
                    <div class="d-flex gap-2">
                        <div>
                            <img src="uploads/<?php echo !empty($commentData['profile_picture']) ? $commentData['profile_picture'] : 'default.png'; ?>"
                                alt="profile-image" class='image rounded-circle'
                                style="width: 32px; height: 32px; object-fit: cover;">

                        </div>
                        <div>
                            <div>
                                <span><a href="viewOthersProfile.php"
                                        class="text-decoration-none text-dark fw-bold"><?php echo $commentData['username'] ?></a></span>
                            </div>
                            <div class="mt-0">
                                <p><?php echo $commentData['created_at']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p><?php echo $commentData['comment_text']; ?></p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-4">
                                <div><i class="fa-solid fa-heart"></i> 0</div>
                                <div><i class="fa-solid fa-comment"></i> 0 </div>
                            </div>
                            <div>Reply</div>
                        </div>
                        <hr>
                    </div>

                    <?php
                } ?>

            </div>
        </div>
    </div>
</div>