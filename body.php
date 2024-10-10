<?php
include 'connection.php';
include 'nav.php';

$fetchSql = "SELECT post_id, username, title, content, created_at FROM users INNER JOIN posts ON users.user_id = posts.user_id";
$fetchResult = mysqli_query($conn, $fetchSql);

?>
<link rel="stylesheet" href="style.css">

<main class="mx-auto w-75 d-flex">
    <div class="w-75 border-end">
        <?php
        while ($result = mysqli_fetch_assoc($fetchResult)) {
        ?>
            <div class="card d-flex m-2 p-2">
                <a href="read-blog.php?id=<?php echo $result['post_id'] ?>"
                class="text-decoration-none text-dark"
                >
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                            alt=""
                            class="image">
                        <span><?php echo $result['username'] ?></span>
                    </div>
                    <div class="d-flex">
                        <div class="w-75">
                            <h2><?php echo $result['title'] ?></h2>
                            <h4><?php echo $result['content'] ?></h4>
                        </div>
                        <div class="w-25 object-fit-fill">
                            <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="" class="w-100">
                        </div>
                    </div>
                    <div><?php echo $result['created_at'] ?></div>
                </a>
            </div>
        <?php
        }
        ?>

    </div>

    <div class="m-2 p-2">
        <?php foreach (range(1, 5) as $i) {
        ?>
            <div class="">
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" class="image">
                    <span>Rakesh Joshi </span>
                </div>
                <p class="h-4">Lorem ipsum dolor sit amet consectetur.</p>
            </div>
        <?php
        } ?>
    </div>
</main>

<?php
// $selectSql = "SELECT"
?>