<?php
require 'connection.php';

$user_id = $_GET['user_id'];
$post_id = $_GET['post_id'];



if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $notifi_text = $_POST['notification'];

    $insertSql = "INSERT INTO notifications (user_id, post_id, notifi_text) VALUES ($user_id, $post_id, '$notifi_text')";
    $insertSqlResult = mysqli_query($conn, $insertSql);

    if ($insertSqlResult) {
        header('location: admin-reports.php');
    }

}

?>
<div class="container">
    <form action="#" method="Post">
        <div class="from-group">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="from-group">
            <label for="notification" class="form-label">Notification</label>
            <input type="notification" class="form-control" name="notification">
        </div>
        
        <input type="submit" name="submit">
    </form>
</div>