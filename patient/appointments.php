<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  patientLogin();
  session_regenerate_id(true);
  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Panel - My Appointments</title>
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
        <h4 class="text-success">My Appointments</h4>
        <div class="col-md-12">
                  <div class="table">
                      <table class="table table-hover">
                          <thead class="bg-info text-light">
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
                              $ap_q = "SELECT * FROM `appointments` WHERE `patient_id` = ? ORDER BY `date` DESC";
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
      </div>
    </div>
  </div>
  <?php require('partials/scripts.php');?>
</body>
</html>
