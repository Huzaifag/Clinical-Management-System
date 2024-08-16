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
  <title>Admin Panel- Dashboard</title>
  <?php require('partials/links.php');?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        <div class="container-fluid">
          <div class="row">
          <div class="heading d-flex justify-content-start align-items-center mb-2">
            <img src="pic/bill (2).png" alt="pic/medReport.png" class="img-fluid me-1" width='50px'>
            <h3 class="text-success"> Customer Bills</h3>
          </div>
            
            <div class="alert alert-success mt-3 shadow-sm" role="alert">
              <div class="table-responsive-md mt-2" style="height: 500px;">
                <table class="table table-hover border mt-3" id="myTable">
                  <thead>
                    <tr class="bg-info text-white text-center">
                      <th scope="col">#</th>
                      <th scope="col">Patient Name</th>
                      <th scope="col">Doctor Fees</th>
                      <th scope="col">Medicine</th>
                      <th scope="col">Lab Test</th>
                      <th scope="col">Total</th>
                      <th scope="col">Date</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="bill_data">
                    <?php
                      $bill_q = "SELECT * FROM `bills` ORDER BY `bills`.`date` DESC";
                      $res = mysqli_query($con, $bill_q);
                      $i = 1;
                      while($data = mysqli_fetch_assoc($res)){
                        $q = "SELECT * FROM `patient` WHERE `id` = ?";
                        $val = [$data['patient_id']];
                        $patient_r = select($q, $val, 'i');
                        $patient_d = mysqli_fetch_assoc($patient_r);
                        if($data['status'] == 0){
                          $status = '<a href="bills_actions/bill_upd.php?pay_id='.$data['bill_id'].'" class="btn btn-sm btn-success">Unpaid</a>';
                        }
                        else{
                          $status = '<a href="bills_actions/bill_upd.php?pay_id='.$data['bill_id'].'" class="btn btn-sm btn-secondary">Paid</a>';
                        }
                        echo '
                          <tr>
                            <td>'.$i.'</td>
                            <td>'.$patient_d['name'].'</td>
                            <td>'.$data['doc_fees'].'</td>
                            <td>'.$data['medicine'].'</td>
                            <td>'.$data['lab_test'].'</td>
                            <td>'.$data['total'].'</td>
                            <td>'.$data['date'].'</td>
                            <td>'.$status.'</td>
                            <td>
                              <a href="bills_actions/bill_del.php?del_id='.$data['bill_id'].'" class="btn btn-sm btn-success"><i class="bi bi-trash3-fill"></i></a>
                              <a href="print_bill.php?bill_id='.$data['bill_id'].'" class="btn btn-sm btn-success" target="_blank"><i class="bi bi-printer-fill"></i></a>
                            </td>
                          </tr>
                        ';
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
  </div>

  <?php require('partials/scripts.php');?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
  </script>
</body>
</html>

