<!-- <link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.bundle.min.js"></script> -->

<!-- <div class="container-fluid">
    <div class="row">
        <div class="bg-primary col-12 col-lg-8">First</div>
        <div class="bg-info col-12 col-lg-4">Second</div>
        <div class="bg-danger col-lg-9">Third</div>
        <div class="bg-dark-subtle col-md-3">Fourth</div>
        <div class="bg-dark-subtle col-12">Footer</div>
    </div>
</div> -->

<!--  -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Blog Post</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
  <div class="container mt-5">
    <h1 class="mb-4">Create a Blog Post</h1>
    <form class="shadow p-4 bg-white rounded">
      <div class="mb-3">
        <label for="title" class="form-label">Blog Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="w-25 mx-auto" id="description" name="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <div style="max-width: 50rem !important; margin:auto ">
    <textarea>
  Welcome to TinyMCE!
  </textarea>
  </div>



  <!-- Place the first <script> tag in your HTML's <head> -->
  <script src="https://cdn.tiny.cloud/1/bu8xy1qdhoi45svuu1wisy4ro8tg8k9uz6wkvopvsqu80oex/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Nov 4, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [{
          value: 'First.Name',
          title: 'First Name'
        },
        {
          value: 'Email',
          title: 'Email'
        },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>

</body>

</html>