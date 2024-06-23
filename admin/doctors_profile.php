<?php
require("partials/essentials.php");
require("partials/db_config.php");
adminLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Doctor Profile</title>
  <?php require('partials/links.php'); ?>
</head>
<body class="bg-light">
  <?php require('partials/header.php'); ?>
  
  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
      
        
        <!-- Query Data Table -->
        <div class="card border-0 shadow-sm mb-4 alert alert-success">
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Doctor Details</h4>
            <?php
            $doc_data = '';
            if(isset($_GET['doc_id'])){
              $doc_id = $_GET['doc_id'];
              $query = "SELECT * FROM `doctor` WHERE `id` = ?";
              $val = [$doc_id];
              $res = select($query, $val, 'i');
              $doc_data = mysqli_fetch_assoc($res);
              $image = $doc_data['image'];
            }
            ?>
            
            <table class="table table-bordered border-dark">
              <tbody>
                <?php
                $status = '';
                if($doc_data['status'] == 0){
                  $status = 'Active';
                }
                else{
                  $status = 'Retired';
                }
                $path = DOCTOR_IMAGE_PATH;
                echo <<<html
                <div class="row">
                  <div class="col-md-2">
                    <img src="$path$doc_data[image]" width="100%" class="img-thumbnail" alt="$doc_data[name]">
                  </div>
                  <div class="col-md-8">
                    <table class="table table-bordered border-dark">
                      <tr>
                        <th scope="row">Name</th>
                        <td>Dr $doc_data[name]</td>
                        <th>Email</th>
                        <td>$doc_data[email]</td>
                      </tr>
                      <tr>
                        <th scope="row">Mobile Number</th>
                        <td>+$doc_data[pn]</td>
                        <th>Address</th>
                        <td>$doc_data[address]</td>
                      </tr>
                      <tr>
                        <th scope="row">Specialization</th>
                        <td>$doc_data[Specialization]</td>
                        <th>Fees</th>
                        <td>$doc_data[fees]</td>
                      </tr>
                      <tr>
                        <th scope="row">Date of Join</th>
                        <td>$doc_data[date_of_join]</td>
                        <th>Status</th>
                        <td><span class="badge bg-info text-dark">$status</span></td>
                      </tr>
                    </table>
                  </div>
                </div>
                html;
                ?>
              </tbody>
            </table>
            
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php require('partials/scripts.php'); ?>
</body>
</html>