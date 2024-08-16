<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  patientLogin();
  session_regenerate_id(true);
  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];
  $query = "SELECT * from `patient` where `id` = ?";
  $value = [$patient_id];
  $result = select($query, $value, 'i');
  $patient = mysqli_fetch_assoc($result);
  $path = PATIENT_IMAGE_PATH; 
  $img = $patient['image']; 
  $patient_name = $patient['name'];
  $hashedPassword = $patient['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Panel - Doctor Profile</title>
  <link rel="icon" type="image/x-icon" href="pic/url.png">
  <?php require('partials/links.php');?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <style>
    .profile_pic{
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin: 10px;
    }
    button{
      margin: 5px;
      border: none;
      background-color: transparent;
      color:light;
      color: lightcyan;
    }
  </style>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        <div class="heading d-flex justify-content-start align-items-center mb-2">
          <img src="pic/User-Profile-Edit.png" alt="pic/report.png" class="img-fluid">
          <h4 class="text-success">Edit Profile</h4>
        </div>
        <div class="container-fluid mt-4"> 
          <div class="row justify-content-between">
          <div class="col-md-4 card bg-secondary text-light shadow">
            <div class="d-flex justify-content-center">
              <img src="<?php echo $path. $img; ?>" alt="profile" class="profile_pic">
            </div>
            <div class="text-center">
              <h5 id= "name_el"></h5>
              <button data-bs-toggle="modal" data-bs-target="#editModal" id ="editBtn">
                ✏ Edit Profile
              </button><br>
              <button data-bs-toggle="modal" data-bs-target="#changePassModal">
                🔐 Change Password</button>
            </div>
          </div>
          <div class="col-md-7 card">
            <div class="row p-2">
              <div class="col-md-6">
                <h5 class="mt-3">Email</h5>
                <p id ="email_el"></p>
                <h5>Phone Number</h5>
                <p id ="phone_el">0</p>
                <h5>Gender</h5>
                <p id="gender_el"></p>
                <input type="text" id="userId" value ="<?php  echo $patient['id'] ;?>" class="form-control" hidden>

              </div>
              <div class="col-md-6">
                <h5 class="mt-3">Address</h5>
                <p id ="address_el"></p>
                <h5>Date of Birth</h5>
                <p id="bDate_el"></p>
                <h5>Date of Join</h5>
                <p><?php echo $patient['date'] ;?></p>
              </div>
            </div>
          </div>
          </div>         
        </div>
        <!-- Edit modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form id="user_form">
                <div class="row">  
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control shadow-none" id="name_inp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="number" class="form-control shadow-none" id="pn_inp">
                      </div>
                      <div class="mb-3">
                        <select class="form-select form-select shadow-none" id="gender_inp">
                          <option selected>Select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control shadow-none" id="email_inp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label shadow-none">Date of Birth</label>
                        <input type="date" class="form-control" id="date_inp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control shadow-none" id="address_inp" rows="3"></textarea>
                      </div>
                    </div>
                </div>     
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary shadow-none">Save</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <!-- Change Password modal -->
        <div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method='POST'>
                  <div class="mb-3">
                    <label class="form-label">Enter Old Password</label>
                    <input type="Password" name="oldPass" class="form-control shadow-none" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Enter New Password</label>
                    <input type="Password" name="newPass" class="form-control shadow-none" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="Password" name="confirmNewPass" class="form-control shadow-none" required>
                  </div>
                  <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="changepass" class="btn btn-primary shadow-none">🔑 Change Password</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script src="script/userCRUD.js"></script>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
      $oldPass = $_POST['oldPass'];
      $newPass = $_POST['newPass'];
      $confirmNewPass = $_POST['confirmNewPass'];

      if ($newPass !== $confirmNewPass) {
        alert('Error','New passwords do not match.');
          exit;
      }

      

      // Verify the old password
      if (!password_verify($oldPass, $hashedPassword)) {
        alert('Error','Old password is incorrect.');
        exit;
      }

      // Hash the new password
      $newHashedPassword = password_hash($newPass, PASSWORD_DEFAULT);

      // Update the password in the database
      $sql2 = "UPDATE patient SET password = ? WHERE id = ?";
      $upd_values = [$newHashedPassword, $patient_id];
      $res2 = update($sql2, $upd_values, 'si');
      if ($res2) {
          alert('success','Password updated successfully.');
      } else {
          alert('Error',"Error updating password: " . $stmt->error);
      }
      
  }
  ?>
</body>
</html>
