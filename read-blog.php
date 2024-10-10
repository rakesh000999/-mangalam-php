<?php
include 'connection.php';

$getBlogId = $_GET['id'];

$fetchSql = "SELECT * FROM posts WHERE post_id = '$getBlogId'";
$fetchResult = mysqli_query($conn, $fetchSql);

$data = mysqli_fetch_assoc($fetchResult);

include 'nav.php';
?>

<link rel="stylesheet" href="bootstrap.min.css">
<div class="container">
    <p class="h1 text-center fw-bolder"><?php echo $data['title']; ?></p>
    <p class="h3 text-center"><?php echo $data['content']; ?></p>
</div>