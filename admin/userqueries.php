<?php
require("partials/essentials.php");
require("partials/db_config.php");
adminLogin();
session_regenerate_id(true);

if(isset($_GET['seen'])){
  $form_data = filteration($_GET);
  if($form_data['seen'] == 'all') {
    $q = "UPDATE `user_queries` SET `seen`= ?";
    $values = [1];
    if(update($q, $values, 'i')) {
        alert('success', 'Marked all as read');
    } else {
        alert('error', 'Something went wrong');
    }
  } else {
      $q = "UPDATE `user_queries` SET `seen`= ? WHERE `sr_no` = ?";
      $values = [1, $form_data['seen']];
      if(update($q, $values, 'ii')) {
          alert('success', 'Marked as read');
      } else {
          alert('error', 'Something went wrong');
      }
  }
}

if(isset($_GET['del'])){
  $form_data = filteration($_GET);
  if($form_data['del'] == 'all') {
    $q = "DELETE FROM `user_queries`";
    if(mysqli_query($con, $q)) {
        alert('success', 'Entries deleted');
    } else {
        alert('error', 'Something went wrong');
    }
  } else {
      $q = "DELETE FROM `user_queries` WHERE `sr_no` = ?";
      $values = [$form_data['del']];
      if(delete($q, $values, 'i')) {
          alert('success', 'Entry deleted');
      } else {
          alert('error', 'Something went wrong');
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel- User Queries</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4" id="alert_div">
        <h3 class="mb-4">User Queries</h3>

        <!-- Query Data Table -->
        <div class="card border-0 shadow-sm mb-4 alert alert-success">
          <div class="card-body">
            <div class="text-end mb-3">
              <a href="?seen=all" class="btn btn-dark btn-sm shadow-none rounded-pill">
                <i class="bi bi-check-all"></i> Mark all as read
              </a>
              <a href="?del=all" class="btn btn-danger btn-sm shadow-none rounded-pill">
                <i class="bi bi-trash3-fill"></i> Delete all
              </a>
            </div>
            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;" id="style-4">
              <table class="table table-hover border">
                <thead class="sticky-top">
                  <tr class="bg-info text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="15%">Subject</th>
                    <th scope="col" width="20%">Message</th>
                    <th scope="col" width="10%">Date</th>
                    <th scope="col" >Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC;";
                    $result = mysqli_query($con,$q);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                      $seen = '';
                      if ($row['seen'] != 1) {
                        $seen .= '<a class="btn btn-sm rounded-pill btn-primary text-white" href="?seen=' . $row['sr_no'] . '" style="font-size: 14px;">Mark as read</a>';
                      }
                      $seen .= '<a class="btn btn-sm rounded-pill btn-danger text-white mt-2" href="?del=' . $row['sr_no'] . '" style="font-size: 14px;">Delete</a>';

                      echo <<<HTML
                        <tr>
                          <td>$i</td>
                          <td>{$row['name']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['subject']}</td>
                          <td>{$row['message']}</td>
                          <td>{$row['date']}</td>
                          <td class="text-center">$seen</td>
                        </tr>
                      HTML;
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require('partials/scripts.php');?>
</body>
</html>
