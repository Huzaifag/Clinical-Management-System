<?php
require("partials/essentials.php");
require("partials/db_config.php");
adminLogin();
session_regenerate_id(true);
?>
<!staffTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Staff Profile</title>
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
            <h4 class="alert-heading">Staff Profile</h4>
            <?php
            $staff_data = '';
            if(isset($_GET['staff_id'])){
              $staff_id = $_GET['staff_id'];
              $query = "SELECT * FROM `staff` WHERE `id` = ?";
              $val = [$staff_id];
              $res = select($query, $val, 'i');
              $staff_data = mysqli_fetch_assoc($res);
              $image = $staff_data['image'];
            }
            ?>
            
            <table class="table table-bordered border-dark">
              <tbody>
                <?php
                $path = ABOUT_IMAGE_PATH;
                echo <<<html
                <div class="row">
                  <div class="col-md-2">
                    <img src="$path$staff_data[image]" width="100%" class="img-thumbnail" alt="$staff_data[name]">
                  </div>
                  <div class="col-md-8">
                    <table class="table table-bordered border-dark">
                      <tr>
                        <th scope="row">Name</th>
                        <td>$staff_data[name]</td>
                        <th>Social Links</th>
                        <td>
                          <ul>
                            <li>$staff_data[fb]</li>
                            <li>$staff_data[insta]</li>
                            <li>$staff_data[tw]</li>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Mobile Number</th>
                        <td>+$staff_data[pn]</td>
                        <th>Address</th>
                        <td>$staff_data[address]</td>
                      </tr>
                      <tr>
                        <th scope="row">Role</th>
                        <td>$staff_data[role]</td>
                        <th>Description</th>
                        <td>$staff_data[description]</td>
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