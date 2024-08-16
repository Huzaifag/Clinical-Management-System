<?php
require("partials/essentials.php");
doctorLogin();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Panel- Blogs</title>
  <link rel="icon" type="image/x-icon" href="pic/blogicon.png">
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4">

    <div class="container-flude">
      <div class="row justify-content-between align-items-center">
        <div class="col-4">
          <div class="heading d-flex justify-content-start align-items-center mb-2">
            <img src="pic/writeBlogs.png" alt="pic/writeBlogs.png" class="img-fluid me-1" width='50px'>
            <h3 class="text-success">Write Blogs</h3>
          </div>
        </div>
        <div class="col-2">
          <button class="btn btn-outline-info shadow-none" data-bs-toggle="modal" data-bs-target="#post_blog">
            <i class="bi bi-journal-text me-2" ></i>New Post
          </button>
      </div>
      <div class="container mt-4">
        <div class="row" id ="blogs_container">
          
        </div>
      </div>
    </div>



<!-- Add post Modal -->
<div class="modal fade" id="post_blog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Post New Blog</h1>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="blog_form">
            <div class="mb-3">
              <label class="form-label">Blog Title:</label>
              <input type="text" class="form-control" name="title" >
            </div>
            <div class="mb-3">
              <label class="form-label">Image:</label>
              <input type="file" name="image" class="form-control shadow-none" accept=".jpg, .png, .webp, .jpeg" required>
            </div>
            <div class="mb-3">
              <label  class="form-label">Blog Body:</label>
              <textarea name="blog" class="form-control shadow-none" rows="6"></textarea>
            </div>
            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary shadow-none">Save</button>
          </form>
      </div>
    </div>
  </div>
</div>
<!--Edit  post Modal -->
<div class="modal fade" id="edit_post_blog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Post New Blog</h1>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="blog_edit_form">
              <input type="text" name="id" id="edit_id">
            <div class="mb-3">
              <label class="form-label">Blog Title:</label>
              <input type="text" class="form-control" name="title_edit" >
            </div>
            <div class="mb-3">
              <label  class="form-label">Blog Body:</label>
              <textarea name="blog_edit" class="form-control shadow-none" rows="6"></textarea>
            </div>
            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary shadow-none">Save</button>
          </form>
      </div>
    </div>
  </div>
</div>
    
    </div>
  </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script src="script/blog.js"></script>
</body>
</html>