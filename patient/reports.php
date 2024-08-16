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
  <title>User Panel - My reports</title>
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
        <div class="heading d-flex justify-content-start align-items-center mb-2">
        <img src="pic/report.png" alt="pic/report.png" class="img-fluid">
        <h4 class="text-success">My Reports</h4>
        </div>
        <div class="col-md-12">
                  <div class="table">
                      <table class="table table-hover">
                          <thead class="bg-info text-light">
                              <tr>
                                  <th>Sr</th>
                                  <th>Blood Pressure</th>
                                  <th>Blood Sugar</th>
                                  <th>Body Temprature</th>
                                  <th>Weight</th>
                                  <th>Check By</th>
                                  <th>Vist date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              $report_q = "SELECT * FROM `reports` WHERE `patient_id` = ? ORDER BY `date` DESC";
                              $report_val = [$patient_id]; // Assuming $patient_id is defined elsewhere
                              $report_res = select($report_q, $report_val, 'i'); // Assuming select function is defined for database query

                              $i = 1;
                              if ($report_res) {
                                  while ($row = mysqli_fetch_assoc($report_res)) {
                                     
                                    $doc_id = $row['doctor_id'];
                                    $query = "SELECT * FROM doctor WHERE `id` = ?";
                                    $val = [$doc_id];
                                    $res = select($query, $val, 'i');
                                    $docData = mysqli_fetch_assoc($res);
                                    $doc_name =$docData['name'];
                                      echo '
                                      <tr>
                                          <td>' . $i . '</td>
                                          <td>' . $row['bp'] . '</td>
                                          <td>' . $row['b_sugar'] . '</td>
                                          <td>' . $row['temp'] . '</td>
                                          <td>' . $row['weight'] . '</td>
                                          <td>' . $doc_name . '</td>
                                          <td>' . $row['date'] . '</td>
                                          <td>
                                           <a href="print_reports.php?report_id='.$row['id'].'" class="btn btn-success btn-sm"><i class="bi bi-printer-fill"></i> Print</a>
                                          </td>
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
