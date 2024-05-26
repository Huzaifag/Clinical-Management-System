<?php
//for Front End data
define('SITE_URL', 'http://127.0.0.1/fyProject/');
define('ABOUT_IMAGE_PATH',SITE_URL.'images/about/');
define('CAROUSEL_IMAGE_PATH',SITE_URL.'images/carousel/');
define('FEATURES_IMAGE_PATH',SITE_URL.'images/features/');
define('ROOMS_IMAGE_PATH',SITE_URL.'images/rooms/');

//Backend Upload process needs this urls
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/fyProject/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FEATURES_FOLDER', 'features/');
define('ROOMS_FOLDER', 'rooms/');

  function alert($type, $msg){
    $bs_class = ($type == 'success') ? 'alert-success':'alert-danger';
    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custem-alert" role="alert">
      <strong>$type!</strong> $msg.
      
    </div>
  alert;
  }

  

  function redirect($url) {
    echo "
    <script>
    window.location.href = '$url';
    </script>
    ";
}

function logout() {
  session_start();
  session_destroy();
  redirect('login.php');
}

function adminLogin() {
  session_start();
  if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
      echo "
      <script>
      window.location.href = 'index.php';
      </script>
      ";
      exit; // Optional: You may want to add an exit statement after the redirect to stop further execution.
  }
}

function uploadImage($image, $folder){
  $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img'; //invalid image formate or type
  }
  else if($image['size']/(1024*1024) > 2){
    return 'inv_size'; //invalid size is greater than 2mb
  }
  else{
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $fname = 'IMG_'.random_int(11111,99999).".$ext";
    $image_path = UPLOAD_IMAGE_PATH.$folder.$fname;
    // Upload the image
    if(move_uploaded_file($image['tmp_name'], $image_path)){
      return $fname; // Return the filename if upload is successful
    }
    else{
      return 'upload_failed'; // Return error if upload fails
    }
  }
}

function deleteImage($image, $folder){
  $image_path = UPLOAD_IMAGE_PATH.$folder.$image;
  if(unlink($image_path)){
    return true;
  }
  else {
    return false;
  }
}

function uploadSVGImage($image, $folder){
  $valid_mime = ['image/svg+xml']; // corrected MIME type
  $img_mime = $image['type'];

  if(!in_array($img_mime, $valid_mime)){
    return 'inv_img'; //invalid image format or type
  }
  else if($image['size']/(1024*1024) > 1){
    return 'inv_size'; //invalid size is greater than 1mb
  }
  else{
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $fname = 'IMG_'.random_int(11111,99999).".$ext";
    $image_path = UPLOAD_IMAGE_PATH.$folder.$fname;
    // Upload the image
    if(move_uploaded_file($image['tmp_name'], $image_path)){
      return $fname; // Return the filename if upload is successful
    }
    else{
      return 'upload_failed'; // Return error if upload fails
    }
  }
}

?>