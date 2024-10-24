<?php
include 'connection.php';
include 'navbar.php';

$user_id = $_SESSION['user_id'];

$getBlogId = $_GET['id'];

$fetchSql = "SELECT * FROM posts WHERE post_id = '$getBlogId'";
$fetchResult = mysqli_query($conn, $fetchSql);

$data = mysqli_fetch_assoc($fetchResult);

// comment
$selectUser = "SELECT * FROM users WHERE user_id = $user_id";
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
$selectComment = "SELECT * FROM comments c INNER JOIN users u ON c.user_id = u.user_id WHERE post_id = '$getBlogId'";
$selectCommentResult = mysqli_query($conn, $selectComment);

$row =  mysqli_num_rows($selectCommentResult);
?>

<link rel="stylesheet" href="bootstrap.min.css">

<div class="row mx-3">
    <div class="col-12 col-lg-8 mt-4">
        <p class="h1 fw-bold"><?php echo $data['title']; ?></p>
        <img src="https://img.freepik.com/free-photo/abstract-autumn-beauty-multi-colored-leaf-vein-pattern-generated-by-ai_188544-9871.jpg?size=626&ext=jpg&ga=GA1.1.117944100.1729209600&semt=ais_hybrid" alt="" class="rounded mt-5 mb-5">
        <p class="h3"><?php echo $data['content']; ?></p>
    </div>
    
    <div class="col-12 col-lg-4 shadow-lg rounded ">
        <p class="fw-bolder h3 mt-3"><?php echo ($row <= 1) ? "Comment ($row)" : "Comments ($row)"; ?></p>
        <div class="card shadow-sm p-2 mt-3">
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                    alt=""
                    class="image">
                <span><a href="viewOthersProfile.php" class="text-decoration-none text-dark fw-bold"><?php echo $userData['username'] ?></a></span>
            </div>
            <form action="#" method="post">
                <div class="mt-2">
                    <textarea name="comment-text" id="" rows="2" class="form-control" placeholder="Write comment here!"></textarea>
                    <span><?php echo isset($error['commentError']) ?  $error['commentError'] : ''; ?></span>
                </div>
                <div class="mt-2">
                    <input type="submit" class="btn btn-success fw-bolder border-0 px-2 py-1 rounded-1" value="Comment" name="submit">
                </div>
            </form>
        </div>
        <div>
            <div class="mt-4 h5 text-danger">
                Dropdown Sort
                <hr>
            </div>
            <div>

                <?php
                while ($commentData = mysqli_fetch_assoc($selectCommentResult)) {
                ?>
                    <div class="d-flex gap-2">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                alt=""
                                class="image">
                        </div>
                        <div>
                            <div>
                                <span><a href="viewOthersProfile.php" class="text-decoration-none text-dark fw-bold"><?php echo $commentData['username'] ?></a></span>
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
                                <div>0 👍</div>
                                <div>0 💬</div>
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