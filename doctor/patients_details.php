<?php
require("partials/essentials.php");
require("partials/db_config.php");
doctorLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Reports</title>
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
            <h4 class="alert-heading">Patient Details</h4>
            <?php
            $pdata = '';
            if(isset($_GET['pid'])){
              $pid = $_GET['pid'];
              $query = "SELECT * FROM `patient` WHERE `id` = ?";
              $val = [$pid];
              $res = select($query, $val, 'i');
              $pdata = mysqli_fetch_assoc($res);
              $image = $pdata['image'];
            }
            ?>
            
            <table class="table table-bordered border-dark">
              <tbody>
                <?php
                $path = PATIENT_IMAGE_PATH;
                echo <<<html
                <div class="row">
                  <div class="col-md-2">
                    <img src="$path$pdata[image]" width="100%" class="img-thumbnail" alt="$pdata[name]">
                  </div>
                  <div class="col-md-8">
                    <table class="table table-bordered border-dark">
                      <tr>
                        <th scope="row">Patient Name</th>
                        <td>$pdata[name]</td>
                        <th>Patient Email</th>
                        <td>$pdata[email]</td>
                      </tr>
                      <tr>
                        <th scope="row">Patient Mobile Number</th>
                        <td>0$pdata[pn]</td>
                        <th>Patient Address</th>
                        <td>$pdata[address]</td>
                      </tr>
                      <tr>
                        <th scope="row">Patient Gender</th>
                        <td>$pdata[gender]</td>
                        <th>Patient Date of Birth</th>
                        <td>$pdata[dob]</td>
                      </tr>
                      <tr>
                        <th scope="row">Patient Medical History</th>
                        <td>N/A</td>
                        <th>Patient Reg Date</th>
                        <td>$pdata[date]</td>
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