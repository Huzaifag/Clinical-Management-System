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
  <title>User Panel - My Bills</title>
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
                                  <th>Doctor Fees</th>
                                  <th>Medicine</th>
                                  <th>Lab Test</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              $bill_q = "SELECT * FROM `bills` WHERE `patient_id` = ? ORDER BY `date` DESC";
                              $bill_val = [$patient_id]; // Assuming $patient_id is defined elsewhere
                              $bill_res = select($bill_q, $bill_val, 'i'); // Assuming select function is defined for database query

                              $i = 1;
                              if ($bill_res) {
                                  while ($row = mysqli_fetch_assoc($bill_res)) {
                                      $status = ($row['status'] == 0) ? '<span class="badge bg-info text-white">Unpaid</span>' : '<span class="badge bg-success text-white">Paid</span>';
                                      echo '
                                      <tr>
                                          <td>' . $i . '</td>
                                          <td>' . $row['doc_fees'] . '</td>
                                          <td>' . $row['medicine'] . '</td>
                                          <td>' . $row['lab_test'] . '</td>
                                          <td>' . $row['total'] . '</td>
                                          <td>' . $status . '</td>
                                          <td>
                                           <a href="pay_bill.php?'.$row['bill_id'].'" class="btn btn-success btn-sm"><i class="bi bi-credit-card-2-front-fill"></i> Pay</a>
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
