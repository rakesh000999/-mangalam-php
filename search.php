<?php
include 'connection.php';
include 'navbar.php';

$search = $_GET['search-text'];

$searchSql = "SELECT * FROM users u INNER JOIN posts p ON u.user_id = p.user_id WHERE title LIKE '%$search%'";
$searchResult = mysqli_query($conn, $searchSql);

?>

<div class="container">
    <p class="h1 fw-bolder">Results for <?php echo $search ?></p>
    <?php
    while ($result = mysqli_fetch_assoc($searchResult)) {
        $postId = $result['post_id'];
        ?>
        <div class="card d-flex m-2 p-2">
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile Image" class="image">
                <span>
                    <a href="viewOthersProfile.php" class="text-decoration-none text-dark">
                        <?php echo $result['username']; ?>
                    </a>
                </span>
            </div>
            <a href="read-blog.php?id=<?php echo $postId; ?>" class="text-decoration-none text-dark">
                <div class="d-flex">
                    <div class="w-75">
                        <h2 class="fw-bolder"><?php echo $result['title']; ?></h2>
                        <h4><?php echo $result['excerpt']; ?></h4>
                    </div>
                    <div class="w-25 object-fit-fill">

                        <img src="uploads/<?php echo $result['blog_image'] ?>" alt="blog_image" class="w-100">
                    </div>
                </div>
                <div class="d-flex gap-4">
                    <div><?php echo $result['created_at']; ?></div>
                    <div>👍 0</div>
                </div>
            </a>
        </div>
        <?php
    }
    ?>
</div>