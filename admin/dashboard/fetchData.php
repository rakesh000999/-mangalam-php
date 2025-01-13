<?php
require 'connection.php'; // Include your database connection file

$sql = "SELECT * FROM reports r INNER JOIN users u ON u.user_id = r.user_id INNER JOIN posts p ON p.post_id = r.post_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='post'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<small>Posted on: " . $row['created_at'] . "</small>";
        echo "</div><hr>";
    }
} else {
    echo "No posts found.";
}
?>