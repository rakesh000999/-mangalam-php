<?php

include 'navbar.php';
require 'connection.php';

$selectSql = "SELECT * FROM notifications n INNER JOIN posts p ON p.post_id = n.post_id";
$selectSqlResult = mysqli_query($conn, $selectSql);
?>

<div class="container">
    <div class="my-5">
        <h1 class="fw-bold">Notifications</h1>
    </div>
    <hr>

    <?php

    while ($row = mysqli_fetch_assoc($selectSqlResult)) {

        if ($_SESSION['user_id'] == $row['user_id']) {
            ?>
            <div class="container ">
                <div class="">
                    <h1><?php echo $row['title']; ?></h1>
                    <h2><?php echo $row['text']; ?></h2>
                    <p><?php echo $row['notifi_text']; ?></p>
                </div>
                <div>
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </div>
            <hr>
            <?php
        }
    }
    ?>
</div>