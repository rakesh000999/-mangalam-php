<?php
include 'connection.php';
include 'nav.php';

$getBlogId = $_GET['id'];

$fetchSql = "SELECT * FROM posts WHERE post_id = '$getBlogId'";
$fetchResult = mysqli_query($conn, $fetchSql);

$data = mysqli_fetch_assoc($fetchResult);

?>

<link rel="stylesheet" href="bootstrap.min.css">
<div class="row">
    <div class="col-12 col-lg-8">
        <p class="h1 fw-bold"><?php echo $data['title']; ?></p>
        <img src="https://img.freepik.com/free-photo/abstract-autumn-beauty-multi-colored-leaf-vein-pattern-generated-by-ai_188544-9871.jpg?size=626&ext=jpg&ga=GA1.1.117944100.1729209600&semt=ais_hybrid" alt="" class="rounded">
        <p class="h3"><?php echo $data['content']; ?></p>
    </div>
    <div class="col-12 col-lg-4 shadow-lg">
        <p class="fw-bolder h3">Comments</p>
        <div class="card shadow p-2">
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                    alt=""
                    class="image">
                <span><a href="viewOthersProfile.php" class="text-decoration-none text-dark">Rakesh</a></span>
            </div>
            <form action="" method="post">
                <div class="mt-2">
                    <textarea name="" id="" rows="2" class="form-control" placeholder="Write comment here!"></textarea>
                </div>
                <div class="mt-2">
                    <button class="bg-info text-white fw-bolder border-0 px-2 py-1 rounded-1">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>