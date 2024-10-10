<?php
include 'connection.php';
session_start();

if (isset($_POST['post'])) {

    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $insertSql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id','$title','$content')";
    $insertResult = mysqli_query($conn, $insertSql);

    if ($insertResult) {
?>
        <div
            class="alert alert-success alert-dismissible fade show container"
            role="alert">
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>

            <strong>Blog posted!</strong>
        </div>
<?php
    }
}

?>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="bootstrap.bundle.min.js"></script>

<div class="container py-1 align-items-center">
    <nav class="d-flex justify-content-between">
        <div>
            <h3 class="text-info-emphasis font-monospace p-0">Mangalam</h3>
        </div>
        <div class="d-flex gap-5 align-items-center">
            <div>
                Noti
            </div>
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" class="image">
            </div>
        </div>
    </nav>
    <hr>
</div>

<div class="container">
    <h3 class="text-center">Write Blog</h3>

    <form action="#" method="post">
        <div class="form-group">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="10"></textarea>
        </div>
        <input type="submit" name="post" value="Post" class="bg-primary my-2 w-100 text-light h5 border-0 p-2 rounded">
    </form>
</div>