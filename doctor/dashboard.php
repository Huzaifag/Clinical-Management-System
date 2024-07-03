<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  doctorLogin();
  session_regenerate_id(true);
  $doc_id = $_SESSION['doctorId'];

  // Fetch dynamic data
  $totalPatients = getTotalPatients($con);
  $totalNewAppointments = getTotalNewAppointments($con);
  $totalUnreadQueries = getTotalUnreadQueries($con);

  function getTotalPatients($con) {
      $stmt = $con->prepare("SELECT COUNT(*) AS count FROM `patient`");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc()['count'];
  }

  function getTotalNewAppointments($con) {
      $stmt = $con->prepare("SELECT COUNT(*) AS count FROM `appointments` WHERE `status` = 0");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc()['count'];
  }

  function getTotalUnreadQueries($con) {
      $stmt = $con->prepare("SELECT COUNT(*) AS count FROM `user_queries` WHERE `seen` = 0");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc()['count'];
  }

  function getPatientDataForChart($con) {
    $stmt = $con->prepare("SELECT `date` FROM `patient`");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return array_reverse($data);
  }

  $chartData = getPatientDataForChart($con);
  $chartData = json_encode($chartData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Dashboard</title>
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
          <div class="row justify-content-between">
            <div class="col-md-3 mb-3 card">
              <div class="dashCard">
                <img src="pic/patient.png"  alt="">
                <h4>Total Patient</h4>
                <div><span class="badge rounded-pill bg-light text-dark fs-5"><?php echo $totalPatients; ?></span></div>
                <a href="patients.php" class="my-2 text-success">
                  View Details
                </a>
              </div>
            </div>
            <div class="col-md-3 mb-3 card">
              <div class="dashCard">
                <img src="pic/appointment.png"  alt="">
                <h4>New Appointments</h4>
                <div><span class="badge rounded-pill bg-light text-dark fs-5"><?php echo $totalNewAppointments; ?></span></div>
                <a href="appointments.php" class="my-2 text-success">
                  View Details
                </a>
              </div>
            </div>
            <div class="col-md-3 mb-3 card">
              <div class="dashCard">
                <img src="pic/query.webp"  alt="">
                <h4>Unread Queries</h4>
                <div><span class="badge rounded-pill bg-light text-dark fs-5"><?php echo $totalUnreadQueries; ?></span></div>
                <a href="userqueries.php" class="my-2 text-success">
                  View Details
                </a>
              </div>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-7">
              <div class="row my-2 bg-white shadow-sm">
                <iframe src="charts.php"  height="350px" frameborder="0"></iframe>
              </div>
            </div>
            <div class="col-md-5">
              <div class="container my-4">
                <div class="card shadow p-4">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h5 class="display-4"></h5>
                      <p class="text-muted">New patients in the last 7 days</p>
                    </div>
                    <div class="d-flex align-items-center text-success">
                      <span class="me-2">12%</span>
                      <svg class="bi bi-arrow-up" width="1em" height="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 12a.5.5 0 0 1-.5-.5V4.707l-3.146 3.147a.5.5 0 1 1-.708-.707l4-4a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1-.708.707L8.5 4.707V11.5a.5.5 0 0 1-.5.5z"/>
                      </svg>
                    </div>
                  </div>
                  <canvas id="patientChart" width="400" height="200"></canvas>
                  <div class="d-flex justify-content-between mt-3">
                  </div>
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
