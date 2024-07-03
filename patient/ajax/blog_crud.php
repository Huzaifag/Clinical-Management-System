<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin(); // Assuming this function starts the session

$doctor_id = $_SESSION['doctorId'];
$doctor_name = $_SESSION['doctorname'];

if(isset($_POST['add_blog'])){
    $frm_data = filteration($_POST);
    
    // Check if 'image' is set in $_FILES and it's not empty
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Check if there were any errors during upload
        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Proceed with file upload
            $img_r = uploadImage($_FILES['image'], BLOG_FOLDER);

            // Check if uploadImage() returns null
            if($img_r === null) {
                alert('error', 'An error occurred during image upload.');
            } else {
                // Handle other cases
                if($img_r == 'inv_img'){
                   echo $img_r;
                }
                else if($img_r == 'inv_size'){
                  echo $img_r;
                }
                else if($img_r == 'upload_failed'){
                  echo $img_r;
                }
                else {
                   $query = "INSERT INTO `blogs`(`title`, `image`, `body`, `posted_by`) VALUES (?,?,?,?)";
                   $values = [$frm_data['title'],$img_r,$frm_data['blog'],$doctor_id];
                   $result = insert($query, $values, 'sssi');
                   if($result){
                    echo 1;
                   }
                }
            }
        } else {
            alert('error', "No image uploaded or invalid file.");
        }
    }
}

if(isset($_POST['get_blogs'])){
    $query = "SELECT * FROM `blogs` ORDER BY `blogs`.`date` DESC";
    $result = mysqli_query($con, $query);
    while($data = mysqli_fetch_assoc($result)){
        $image = $data['image'];
        $path = BLOGS_IMAGE_PATH;
        $originalDateTime = $data['date'];
        $dateTime = new DateTime($originalDateTime);
        $formattedDateTime = $dateTime->format('d-F-Y h:i:s A');
        echo <<<blog
            <div class="card mb-3 col-md-12" style="max-width: 100%;">
            <div class="row g-0">
              <div class="col-md-4 d-flex align-items-center">
                <img src="$path$image" class="img-thumbnail" alt="..." id="blog_pic">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <p class="text-end">
                    <button class ="btn btn-sm shadow-none" onclick = "edit_post($data[blog_id])"><i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#edit_post_blog"></i></button>
                    <button class ="btn btn-sm shadow-none" onclick = "delete_post($data[blog_id])" ><i class="bi bi-x-lg"></i></button>
                  </p>
                  <h5 class="card-title">$data[title]</h5>
                  <p class="card-text">$data[body]</p>
                  <p class="card-text"><small class="text-muted">Posted on: $formattedDateTime</small></p>
                </div>
              </div>
            </div>
          </div>
        blog; 
    }
}

if(isset($_POST['delete_blogs'])) {
   // Sanitize input
   $frm_data = filteration($_POST); // Assuming filteration function exists

   // Check if doctor exists
   $pre_q = "SELECT * FROM `blogs` WHERE `blog_id` = ?";
   $res = select($pre_q, [$frm_data['delete_blogs']], 'i');

   if($res) {
       if(mysqli_num_rows($res) > 0) {
           // doctor exists, fetch associated icon
           $img = mysqli_fetch_assoc($res);

           // Attempt to delete associated icon
           if(deleteImage($img['image'], BLOG_FOLDER)){
               // Icon deleted, now delete doctor
               $q = "DELETE FROM `blogs` WHERE `blog_id` = ?";
               $res = delete($q, [$frm_data['delete_blogs']], 'i');

               // Check if deletion was successful
               if($res) {
                    echo $res;
               } else {
                   echo "Failed to delete doctor";
               }
           } else {
               echo "Failed to delete image";
           }
       } else {
           echo "doctor not found";
       }
   } else {
       echo "Error executing database query: " . mysqli_error($connection); // Change $connection to your database connection variable
   }

}

if(isset($_POST['edit_blog'])){
  $q = 'SELECT * FROM `blogs` WHERE `blog_id` = ?';
  $value = [$_POST['edit_blog']];
  $res = select($q, $value, 'i');
  if($res){
    $blog_data = mysqli_fetch_assoc($res);
    echo json_encode($blog_data) ;
  }
  else{
    echo "Failed to fetch blog data";
  }
}

if(isset($_POST['update_blog'])){
  $frm_data = filteration($_POST);
  $query = "UPDATE `blogs` SET `title`= ?,`body`= ?  WHERE `blog_id`= ?";
  $values = [$frm_data['title_edit'],$frm_data['blog_edit'],$frm_data['blog_id']];
  $result = update($query, $values, 'ssi');
  if($result){
    echo $result;
  }
  else{
    echo 'Query failed...';
  }
}

?>
