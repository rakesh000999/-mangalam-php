<?php

require 'connection.php';


$post_id = $_GET['post_id'];

$deleteSql = "DELETE FROM posts WHERE post_id = $post_id";
$deleteSqlResult = mysqli_query($conn, $deleteSql);


if ($deleteSqlResult) {
    header('location: admin-reports.php');
}


?>