<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  patientLogin();
  session_regenerate_id(true);

  if (!isset($_SESSION['userId']) || !isset($_SESSION['username'])) {
      // Handle the case where session variables are not set
      die("User not logged in");
  }

  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submit"])){
      $review = trim($_POST["review"]);
      $stars = intval($_POST["stars"]);

      // Basic validation
      if (empty($review) || $stars < 1 || $stars > 5) {
          echo "Invalid input";
          exit;
      }

      // Prepare the query
      $query = "INSERT INTO `ratings`(`review`, `stars`, `patient_id`) VALUES (?, ?, ?)";
      $values = [$review, $stars, $patient_id];

      $result = insert($query, $values, 'ssi');

      if ($result) {
          header("Location: feedback.php?success=1");
          exit();
      } else {
          echo "Query failed: " . mysqli_error($conn);
      }
    }
  }
  if(isset($_GET["success"])){
    if($_GET["success"] == 1){
      alert("Success", "Your Review has been Submitted.");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Panel - My Bills</title>
  <?php require('partials/links.php'); ?>
</head>
<body class="bg-light">
  <?php require('partials/header.php'); ?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        <h2 class="text-dark">We want your <span class="text-primary">Feedback</span></h2>
        <div class="col-md-12">
          <div class="row">
            <div class="col-lg-6">
              <img src="pic/Online Review.gif" alt="">
            </div>
            <div class="col-lg-6">
              <form id="review-form" method="post">
                <label for="review-text">Write a review:</label>
                <textarea class="form-control shadow-none" id="review-text" name="review" cols="30" rows="5"></textarea>
                <br><br>
                <label for="stars">Rating:</label>
                <select class="form-select shadow-none" id="stars" name="stars">
                  <option value="1">⭐</option>
                  <option value="2">⭐⭐</option>
                  <option value="3">⭐⭐⭐</option>
                  <option value="4">⭐⭐⭐⭐</option>
                  <option value="5">⭐⭐⭐⭐⭐</option>
                </select>
                <br><br>
                <input type="submit" class="btn btn-primary shadow-none" value="Submit Review" name="submit">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require('partials/scripts.php'); ?>
</body>
</html>
