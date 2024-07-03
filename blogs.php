<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS - BLOGS</title>
  <?php require('partials/links.php');?> 
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
  <div class=" container-fluid my-5 px-4">
    <h2 class="text-center h-font fw-bol text-primary">BLOGS</h2>
    <div class="h-line bg-primary"></div>
      <p class="text-center mt-3">
        Discover expert health insights and practical wellness tips on our blog. From preventive  care to medical breakthroughs, <br> we cover diverse topics to inform your health  decisions. Stay updated with trusted information from our healthcare professionals.
      </p>

      <div class="container">
        <div class="row">
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
  </div>


  <?php require('partials/footer.php')?>

</body>
</html>