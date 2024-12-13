<?php
include 'connection.php';

$search = $_GET['search-text'];

$searchSql = "SELECT * FROM users u INNER JOIN posts p ON u.user_id = p.user_id WHERE title LIKE '%$search%'";
$searchResult = mysqli_query($conn, $searchSql);

?>
<style>
    .hover-list:hover {
        background-color:black ;
    }
</style>

<div class="rounded shadow-lg z-3 bg-secondary">
    <ul type="none" class="pt-3">
        <?php
        while ($result = mysqli_fetch_assoc($searchResult)) {
            $postId = $result['post_id'];

            ?>
            <a href="read-blog.php?id=<?php echo $postId; ?>" class="text-decoration-none text-white">
                <li class="hover-list">
                    <p class="fw-bolder" class="">🔍<?php echo $result['title']; ?></p>
                </li>
            </a>
            <?php
        }
        ?>
    </ul>
</div>