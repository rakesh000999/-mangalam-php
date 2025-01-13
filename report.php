<?php
include 'navbar.php';
require 'connection.php';

if (isset($_POST['submit'])) {

    $postId = $_GET['postId'];

    $userId = $_SESSION['user_id'];

    $issue = $_POST['report'];
    $description = $_POST['description'];

    $insertSql = "INSERT INTO reports (user_id, post_id, issue, description) VALUES ($userId, $postId, '$issue', '$description')";

    $insertSqlResult = mysqli_query($conn, $insertSql);

    if ($insertSqlResult) {
        ?>
        <div class="alert alert-primary alert-dismissible fade show container" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Report submitted successfullReport submitted successfully!
        </div>

        <?php
    }

}
?>

<div class="container">

    <form action="" method="post">

        <div class="form-group">
            <input type="radio" name="report" id="spam" value="spam" class="form-check-input">
            <label for="spam">Spam</label>
        </div>

        <div class="form-group">
            <input type="radio" name="report" id="inappropriate" value="inappropriate" class="form-check-input">
            <label for="inappropriate">Inappropriate</label>
        </div>

        <div class="form-group">
            <input type="radio" name="report" id="harassment" value="harassment" class="form-check-input">
            <label for="harassment">Harassment</label>
        </div>

        <div class="form-group">
            <input type="radio" name="report" id="ai" value="ai" class="form-check-input">
            <label for="ai">AI Generated</label>
        </div>

        <div class="form-group my-3">
            <label for="report-text">Report Description</label>
            <textarea name="description" id="report-text" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="modal-footer">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

    </form>
</div>