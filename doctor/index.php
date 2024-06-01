<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <?php
    require("partials/links.php");
    require("partials/essentials.php");
    require("partials/db_config.php");
    session_start();
      if ((isset($_SESSION['doctor_loggedin']) && $_SESSION['doctor_loggedin'] == true)) {
        redirect('dashboard.php');
      }
?>
  <style>
    img{
      width: 100%;
    }
    .container{
      margin-top: 70px;
    }
    .main{
      background-image: url(pic/cover.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
    }
    .login{
      backdrop-filter: blur(10px);
    }
    /* Add this CSS */
    .row {
      display: flex;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row shadow p-4 m-4 justify-content-evenly align-items-center main">
        
        <div class="col-md-5 p-4 border border-2 shadow login rounded-3 mb-3 order-md-1">
          <h2 class="text-center mb-4 bg-primary text-white p-2">DOCTOR LOG IN</h2>
          <form method="post">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control shadow-none" placeholder="Enter email" name="email">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" class="form-control shadow-none"  placeholder="Enter Password" name="password">
          </div>
          <div class="text-center">
          <button type="submit" class="btn btn-outline-primary btn-lg" name="login">Log in</button>
          </div>
          </form>
        </div>
        <div class="col-md-5 ">
          <img src="pic/doctor.png" class="rounded-3" alt="">
        </div>
    </div>
  </div>
</body>
</html>

<?php
// Start the session
// session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $doctorEmail = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `doctor` WHERE `email` = '$doctorEmail'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);
        if ($row == 1) {
            while ($hash = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $hash['password'])) {
                    $logIn = true;
                    $_SESSION['doctor_loggedin'] = true;
                    $_SESSION['doctorname'] = $hash['name'];
                    $_SESSION['doctorId'] = $hash['id'];
                    redirect('dashboard.php');
                    exit; // Added to stop further execution after redirection
                }
                else{
                  alert('Failed', 'Wrong Credentials...');
                }
            }
        }
    }
}
?>