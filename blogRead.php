<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HG Hotels - CONTACT</title>
  <?php require('partials/links.php');?> 
  <style>
    .main-blog-pic{
      height: 350px;
      width: 450px;
      object-fit: cover;
      object-position: center;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
<?php
  $blog = [];
  $doctor = [];
  if(isset($_GET['blogid'])) {
      function get_Blog($blogid) {
          global $con;
          $stmt = $con->prepare('SELECT * FROM `blogs` WHERE `blog_id` = ?');
          $stmt->bind_param('i', $blogid);
          $stmt->execute();
          $result = $stmt->get_result();
          return $result->fetch_assoc();
      }

      $blog = get_Blog($_GET['blogid']);

      if ($blog) {
          function get_Doctor($doctor_id) {
              global $con;
              $stmt = $con->prepare('SELECT * FROM `doctor` WHERE `id` = ?');
              $stmt->bind_param('i', $doctor_id);
              $stmt->execute();
              $result = $stmt->get_result();
              return $result->fetch_assoc();
          }

          $doctor = get_Doctor($blog['posted_by']);

          $blog_path = BLOGS_IMAGE_PATH;
          
          // echo "<pre>";
          // print_r($blog);
          // print_r($doctor);
          // echo "</pre>";
      } else {
          echo "Blog not found.";
      }
  }
  $comments_q = "SELECT * FROM `comments` WHERE `blog_id` =? ORDER BY `comments`.`timedate` DESC";
  $comments_val = [$_GET['blogid']];
  $comments_r = select($comments_q, $comments_val, 'i');
?>
  <div class=" container-fluid my-5 px-4">
    <div class="container alert alert-info" role="alert">
      <div class="row justify-content-evenly align-items-center">
        <div class="col-md-7">
          <h3 class="h-font"><?php  echo $blog['title'];?></h3>

          <p>Posted By: Dr <?php echo $doctor['name']. ' ('.$doctor['Specialization'].')';?></p>
          <p><?php  echo $blog['body'];?></p>
          <span class="badge bg-light text-dark">
            <?php
              $date = new DateTime($blog['date']);
              $formatted_date = strtoupper($date->format('M d, Y g:i A'));
              echo $formatted_date;
            ?>
          </span>
        </div>
        <div class="col-md-4">
          <img src="<?php echo $blog_path.$blog['image'];?>" class="img-thumbnail main-blog-pic" alt="...">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <button class="btn btn-outline-success shadow-none" id="displayComments">Comments</button>
            </li> 
            <li class="nav-item ms-3">
              <button class="btn btn-outline-success shadow-none" id="displayBlogs">More Blogs</button>
            </li>
          </ul>
        </div>
        <div class="col-md-12 mt-4">
          <div class="container" id="blogs">
            <div class="row">
              <h4>Latest Posts</h4>
              <?php
                function get_Blogs() {
                    global $con;
                    $stmt = $con->prepare('SELECT * FROM `blogs`');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    return $result->fetch_all(MYSQLI_ASSOC);
                }

                $blogs = get_Blogs();
                $blog_path = BLOGS_IMAGE_PATH;
                foreach ($blogs as $blog) {
                    $date = new DateTime($blog['date']);
                    $formatted_date = strtoupper($date->format('M d, Y g:i A'));
                    echo '
                    <div class="col-lg-4 col-md-6 my-3 pop">
                        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                            <img src="'.htmlspecialchars($blog_path.$blog['image']).'" class="card-img-top blog-pic" alt="blog-pic">
                            <div class="card-body">
                                <h5>'.htmlspecialchars($blog['title']).'</h5>
                                <span class="badge rounded-pill bg-light text-dark">'.htmlspecialchars($formatted_date).'</span>
                                <p>'.htmlspecialchars(substr($blog["body"], 0, 120)).'...</p>
                                <div class="d-flex justify-content-evenly">
                                    <a href="blogRead.php?blogid='.htmlspecialchars($blog["blog_id"]).'" class="btn btn-sm btn-outline-success shadow-none">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
              ?>
            </div>
          </div>
          <div class="container my-5" id="comments">
            <h1 class="mb-4">Comments</h1>
            <div class="row">
              <!-- Column for posting comments -->
              <div class="col-md-6 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <form method = "POST">
                              <div class="mb-3">
                                  <label for="commentText" class="form-label">Leave a comment</label>
                                  <textarea class="form-control shadow-none" name="comment" id="commentText" rows="3"></textarea>
                              </div>
                              <button type="submit" name="post_comment" class="btn btn-primary">Post</button>
                          </form>
                      </div>
                  </div>
              </div>
              <!-- Column for displaying comments -->
              <div class="col-md-6">
                  <!-- Example comment -->
                  <?php
                    // Fetch comments from the database
                    while($comment = mysqli_fetch_assoc($comments_r)) {
                        // Prepare the query to fetch user details
                        $user_q = "SELECT * FROM `patient` WHERE `id` = ?";
                        $user_val = [$comment['user_id']];
                        $user_r = select($user_q, $user_val, 'i');
                        $user_d = mysqli_fetch_assoc($user_r);

                        // Ensure data is safe to display
                        $user_name = htmlspecialchars($user_d['name']);
                        $comment_text = htmlspecialchars($comment['comment']);
                        $comment_datetime = htmlspecialchars($comment['timedate']);
                        $date = new DateTime($comment_datetime);
                        $formattedDate = $date->format('F j, Y \a\t g:i A');

                        // Output the comment with HTML
                        echo <<<HTML
                        <div class="comment-card">
                            <div class="comment-details">
                                <i class="bi bi-person-circle profile-icon"></i>
                                <span class="fw-bold">$user_name</span>
                                <span class="comment-date">$formattedDate</span>
                            </div>
                            <p class="mt-2">$comment_text</p>
                        </div>
                        HTML;
                    }
                  ?>

                  <!-- Additional comments can be added here -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php require('partials/footer.php')?>
  <script>
    $(document).ready(function(){
      $("#blogs").hide();

      $("#displayBlogs").click(function(){
        $("#blogs").show(1000);
        $("#comments").hide();
      });
      $("#displayComments").click(function(){
        $("#blogs").hide();
        $("#comments").show(1000);
      });

    });
  </script>

</body>
</html>



<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_comment'])) {
    // Check if user is logged in
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $comment = $_POST['comment'];
        $blog_id = $_GET['blogid'];
        $user_id = $_SESSION['userId'];

        // Prepare SQL query
        $query = "INSERT INTO comments (blog_id, user_id, comment) VALUES (?,?,?)";
        $val = [$blog_id, $user_id, $comment];
        $res = insert($query, $val, 'iis');
        if ($res) {
            alert('success', 'Your comment has been posted.');
        } else {
            alert('danger', 'Failed to post your comment.');
        }
    } else {
        alert('warning', 'Please login to send a comment.');
    }
  }
?>