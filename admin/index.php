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
      if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
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
          <h2 class="text-center mb-4 bg-primary text-white p-2">ADMIN LOG IN</h2>
          <form method="post">
          <div class="mb-3">
            <label class="form-label">Admin Name</label>
            <input type="text" class="form-control shadow-none" placeholder="Enter Name" name="name">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Admin Password</label>
            <input type="password" class="form-control shadow-none"  placeholder="Enter Password" name="password">
          </div>
          <div class="text-center">
          <button type="submit" class="btn btn-outline-primary btn-lg" name="login">Log in</button>
          </div>
          </form>
        </div>
        <div class="col-md-5 ">
          <img src="pic/admin.png" class="rounded-3" alt="">
        </div>
    </div>
  </div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['login'])){
    $data = filteration($_POST);

    $query = "SELECT * FROM `admin_credantials` WHERE `name` = ? AND `password` = ?";
    $values = [$data['name'], $data['password']];
    $result = select($query, $values, 'ss');

    if($result){
      $num_rows = mysqli_num_rows($result);
      if($num_rows == 1) {
        session_start();
        $_SESSION['adminLogin'] = true;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        redirect('dashboard.php');
    }
      else{
        alert('error', 'wrong Credatials');
      }
    }

  }
}
?>