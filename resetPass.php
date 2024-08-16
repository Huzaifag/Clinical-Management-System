<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Clinic - RESET PASSWORD</title>
  <?php require('partials/links.php');?> 
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <img src="images/Resetpassword.png" class="img-fluid" alt="...">
      </div>
      <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
        <form class="card shadow-sm p-5" method="post">
          <h2 class="text-center mb-4">FORGET PASSWORD</h2>
          <div class="mb-3">
            <label class="form-label">Enter Verification Code</label>
            <input type="number" name="v_code" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Enter New Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="cpassword" name="cpassword" class="form-control" required>
          </div>
          <button type="submit" name="resetPass" class="btn btn-primary btn-lg">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
  <?php require('partials/footer.php')?>
</body>
</html>

<?php
if(isset($_POST['resetPass'])){
  $v_code = $_POST['v_code'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $conn = mysqli_connect("localhost", "root", "", "cms");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    exit;
  }
  else{
    $sql = "SELECT * FROM `reset_pass` WHERE `verify_code` = '$v_code'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result);
      if($password == $cpassword && $data['is_verify'] == 0){
        $sql = "UPDATE `reset_pass` SET `is_verify` = 1 WHERE `verify_code` = '$v_code'";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user_query = "UPDATE `patient` SET `password`='$hash' WHERE `email` = '$data[user_email]'";
        if(mysqli_query($conn, $sql) && mysqli_query($conn, $user_query)){
          echo "<script>alert('Password Reset Successfully');
          window.location.href='index.php'</script>";
        }
      }else{
        echo "<script>
              alert('Password and Confirm Password do not match');
              window.location.href='resetPass.php';
          </script>";
      }
    }else{
      echo "<script>
              alert('Invalid Verification Code');
              window.location.href='resetPass';
          </script>";
    }
  }
}
?>
