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
  <title>Doctor Panel - Reports</title>
  <link rel="icon" type="image/x-icon" href="pic/reports.png">
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
            <h3 class="mb-4">Patient Medical History</h3>
            <div class="col-md-2 mt-3 align-self-end"> 
            <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#newRoprt">
              New Report
            </button>
            </div>
            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;" id="style-4">
            <table class="table mt-3 shadow-sm">
              <thead>
                <tr class ="bg-info text-white">
                  <th scope="col">#</th>
                  <th scope="col">Blood Pressure</th>
                  <th scope="col">Blood Sugar</th>
                  <th scope="col">Body Temprature</th>
                  <th scope="col">Weight</th>
                  <th scope="col">Vist date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id= "report_data" >
              </tbody>
            </table>
            </div>
          </div>
          <!-- Modal -->
        <div class="modal fade" id="newRoprt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Generate Report</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" id="report_form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Blood pressure:</label>
                        <input type="number" name = "bp" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Body Temprature:</label>
                        <input type="number" name="temp" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Height:</label>
                        <input type="number" name="height" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Blood Sugar:</label>
                        <input type="number" name="b_sugar" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Pulse:</label>
                        <input type="number" name="pulse" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Weight:</label>
                        <input type="number" name="weight" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label">Symptom list:</label><br>
                        <?php
                          $res = selectAll('symptoms');
                          if($res){
                            while($symptom = mysqli_fetch_assoc($res)){
                              echo <<<symptoms
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" value="$symptom[id]" name="symptoms">
                                    <label class="form-check-label" for="flexCheckDefault">$symptom[symptom]</label>
                                </div>
                              symptoms;
                            }
                          }
                        ?>
                    </div>

                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label">Chief complaint:</label>
                        <textarea class="form-control shadow-none" name="chief_complaint" rows="3"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Medical prescription:</label>
                        <textarea name="medical_prescription" class="form-control shadow-none" rows="3"></textarea>
                      </div>
                      <input type="hidden" name ="patient_id" value ="<?php echo $pdata['id'];?>">
                    </div>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary shadow-none">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script src= "script/report.js"></script>
  
  <?php require('partials/scripts.php'); ?>
</body>
</html>