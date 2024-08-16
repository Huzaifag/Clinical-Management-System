<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  patientLogin();
  session_regenerate_id(true);
  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];

  $patient_q = "SELECT * FROM `patient` WHERE `id` = ?";
  $patient_val = [$patient_id];
  $patient_r = select($patient_q, $patient_val, 'i');
  $patient_data = mysqli_fetch_assoc($patient_r);
  $patient_name = $patient_data['name'];
  $patient_gender = $patient_data['gender'];
  $patient_address = $patient_data['address'];
  $patient_dob = $patient_data['dob'];
  $current_date = new DateTime();
  $dob = new DateTime($patient_dob);
  $age = $current_date->diff($dob)->y;
  $path = PATIENT_IMAGE_PATH;

  $report_q = "SELECT *  FROM `reports` WHERE `patient_id` = ? ORDER BY `reports`.`date` DESC LIMIT  1";
  $report_val = [$patient_id];
  $report_r = select($report_q, $report_val, 'i');
  $report_data = mysqli_fetch_assoc($report_r);
  $height = $report_data['height'] / 100 || "No data Available";
  $weight = $report_data['weight'] || "No data Available";        // Weight in kilograms
  $bmi = 0;
  // Calculate BMI
  if ($height > 0) {
    $bmi = $weight / ($height * $height);
    $bmi = round($bmi, 2);
  } else {
    echo "Error: Invalid height provided.";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Panel - Dashboard</title>
  <?php require('partials/links.php');?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        <div class="container-fluid">
          <div class="row">
            <div class="container mt-4">
              <div class="alert alert-primary" role="alert">
                <div class="row justify-content-evenly" style = "height: 150px">
                  <div class="col-md-7">
                    <h2 class="h-font mt-3">Welcome 👋, Dear <?php echo  $patient_name;?></h2>
                    <p>Your health journey unfolds here, where every detail of your care and wellness meets seamlessly. Welcome to your personalized health dashboard.</p>
                  </div>
                  <div class="col-md-4 userImg">
                    <img src="pic/pic1.png" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row justify-content-evenly mt-4">
                <div class="col-md-6">
                  <h4 class="text-success">Profile</h4>
                  <div class="card p-4 shadow">
                    <div class="row">
                      <div class="col-4 profileImg">
                        <img src="<?php echo $path. $patient_data['image'];?>" alt="">
                      </div>
                      <div class="col-4">
                        <h6>Name:</h6>
                        <h6>Age:</h6>
                        <h6>Gender:</h6>
                      </div>
                      <div class="col-4">
                        <p class="p-0 m-0"><?php echo $patient_name; ?></p>
                        <p class="p-0 m-0"><?php echo $age; ?></p>
                        <p class="p-0 m-0"><?php echo $patient_gender; ?></p>
                      </div>
                      <div class="col-12">
                        <div class="row justify-content-center">
                          <hr class="mt-2">
                          <div class="col-3">
                            <h6>Address:</h6>
                          </div>
                          <div class="col-6">
                          <p class="p-0 m-0"><?php echo $patient_address; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h4 class="text-success">Last Report</h4>
                  <div class="card p-4 shadow">
                        <div class="row justify-content-center">
                          <div class="col-5">
                            <h6>Blood Pressure:</h6>
                            <h6>Blood Sugar:</h6>
                            <h6>Blody Temprature:</h6>
                            <h6>Weight:</h6>
                            <h6>BMI:</h6>
                          </div>
                          <div class="col-6">
                            <p class="p-0 m-0 mb-1"><?php echo $report_data['bp']; ?> (mmHg)</p>
                            <p class="p-0 m-0 mb-1"><?php echo $report_data['b_sugar']; ?> (mg/dL)</p>
                            <p class="p-0 m-0 mb-1"><?php echo $report_data['temp']; ?> (°C)</p>
                            <p class="p-0 m-0 mb-1"><?php echo $report_data['weight']; ?> (kg)</p>
                            <p class="p-0 m-0 mb-1"><?php echo $bmi; ?> (kg/m2)</p>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row justify-content-evenly align-items-center mt-4">
                <div class="col-md-6">
                  <div class="d-flex justify-content-between align-items-center">
                      <h4 class="text-success">My Appointments</h4>
                      <span><a href="#">View More</a></span>
                  </div>
                  <div class="table">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Sr</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Doctor</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              $ap_q = "SELECT * FROM `appointments` WHERE `patient_id` = ? ORDER BY `date` DESC LIMIT 7";
                              $ap_val = [$patient_id]; // Assuming $patient_id is defined elsewhere
                              $ap_res = select($ap_q, $ap_val, 'i'); // Assuming select function is defined for database query

                              $i = 1;
                              if ($ap_res) {
                                  while ($row = mysqli_fetch_assoc($ap_res)) {
                                      $doctor_id = $row['doctor_id'];
                                      $status = ($row['status'] == 0) ? '<span class="badge bg-info text-white">Pending</span>' : '<span class="badge bg-success text-white">Approved</span>';
                                      $time = $row['time'];
                                      $dateTime = DateTime::createFromFormat('H:i:s', $time);
                                      $timeFormatted = $dateTime->format('h:i A');
                                      $doc_q = "SELECT * FROM `doctor` WHERE `id` = ?";
                                      $doc_val = [$doctor_id];
                                      $doc_res = select($doc_q, $doc_val, 'i'); // Assuming select function is defined for database query
                                      $doc_data = mysqli_fetch_assoc($doc_res);
                                      $doc_name = $doc_data['name'];

                                      echo '
                                      <tr>
                                          <td>' . $i . '</td>
                                          <td>' . $row['date'] . '</td>
                                          <td>' . $timeFormatted . '</td>
                                          <td>' . $doc_name . '</td>
                                          <td>' . $status . '</td>
                                      </tr>';

                                      $i++;
                                  }
                              }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <img src="pic/pic2.png" class="img-fluid" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require('partials/scripts.php');?>
</body>
</html>
