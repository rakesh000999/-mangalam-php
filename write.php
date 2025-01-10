<?php
include 'connection.php';

if (isset($_POST['post'])) {

  session_start();

  $user_id = $_SESSION['user_id'];
  $postTitle = $_POST['title'];
  $excerpt = $_POST['excerpt'];
  $content = $_POST['content'];

  $image_final_name = '';

  // if (isset($_POST['blog-image'])) {
  $image = $_FILES['blog-image'];
  $title = $image['name']; //name is pre-defined...

  $image_name = $image['name']; //name is pre-defined...
  $image_size = $image['size']; // size is pre-defined...

  if ($title != "" && $image_name != "") {
    $image_array = explode('.', $image_name);
    $extension = end($image_array);

    if ($extension === 'jpg' || $extension === 'png' || $extension === 'jpeg') {
      if ($image_size === 0) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    File size exceeds maximum value. Only file less than 2 MB is supported.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
      } elseif ($image_size > 0 && $image_size < 2097152) {
        $image_final_name = strtolower(str_replace(" ", "", $title) . "-" . time() . "." . $extension);
        // echo $image_final_name;

        if (move_uploaded_file($image['tmp_name'], "uploads/" . $image_final_name)) {

          $insertSql = "INSERT INTO posts (user_id, title, blog_image, excerpt, content) VALUES ('$user_id','$postTitle','$image_final_name','$excerpt','$content')";
          $insertResult = mysqli_query($conn, $insertSql);

          if ($insertResult) {
            ?>
            <div class="alert alert-success alert-dismissible fade show container" role="alert">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              <strong>Blog posted!</strong>
            </div>
            <?php
          }

        }
      } else {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          File type is not supported. Only jpg, png and jpeg is supported!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
      }
    } else {
    }
  } else {
    ?>
    <div class="container alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Image is required!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.tiny.cloud/1/bu8xy1qdhoi45svuu1wisy4ro8tg8k9uz6wkvopvsqu80oex/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#content'
    });
  </script>

  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="bootstrap.bundle.min.js"></script>
</head>

<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <h3 class="text-center fw-bold">Write Blog</h3>

    <form action="#" method="post" enctype="multipart/form-data" class="shadow p-4 rounded">
      <div class="form-group my-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" required>
      </div>

      <div class="form-group my-3">
        <label for="blog-image" class="form-label">Image</label>
        <input type="file" name="blog-image" id="blog-image" class="form-control">
      </div>

      <div class="form-group my-3">
        <label for="excerpt" class="form-label">Excerpt</label>
        <input type="text" name="excerpt" class="form-control" id="excerpt" required>
      </div>

      <div class="form-group">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control" rows="10"></textarea>
      </div>

      <input type="submit" name="post" value="Post" class="bg-primary my-2 w-100 text-light h5 border-0 p-2 rounded">
    </form>
  </div>
</body>

</html>