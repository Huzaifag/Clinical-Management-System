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
            <h3 class="mb-4">Patient Medical Test History</h3>
            <div class="col-md-2 mt-3 align-self-end"> 
            <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#newReport">
              New Test Report
            </button>
            </div>
            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;" id="style-4">
            <table class="table mt-3 shadow-sm">
              <thead>
                <tr class ="bg-info text-white">
                  <th scope="col">#</th>
                  <th scope="col">Examination Type:</th>
                  <th scope="col">Probe/Frequency Used:</th>
                  <th scope="col" style="width: 30%">Reason for Examination</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id= "test_data" >
              </tbody>
            </table>
            </div>
          </div>
          <!-- Modal -->
        <div class="modal fade" id="newReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Generate Report</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" id="test_form">
                <div class="row">
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">Examination Type:</label>
                          <select class="form-select" name="ex_type">
                              <option selected>Select Ultrasound Examination Type</option>
                              <option value="Abdominal">Abdominal Ultrasound</option>
                              <option value="Pelvic">Pelvic Ultrasound</option>
                              <option value="Obstetric">Obstetric Ultrasound</option>
                              <option value="Transvaginal">Transvaginal Ultrasound</option>
                              <option value="Transrectal">Transrectal Ultrasound</option>
                              <option value="Thyroid">Thyroid Ultrasound</option>
                              <option value="Breast">Breast Ultrasound</option>
                              <option value="Vascular">Vascular Ultrasound</option>
                              <option value="Musculoskeletal">Musculoskeletal Ultrasound</option>
                              <option value="Cardiac">Cardiac Ultrasound (Echocardiography)</option>
                              <option value="Renal">Renal Ultrasound</option>
                              <option value="Hepatic">Hepatic (Liver) Ultrasound</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">Probe/Frequency Used:</label>
                          <input type="number" name="probe" class="form-control shadow-none" step="0.01" min="0.00">
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="mb-3">
                        <label class="form-label">Reason for Examination:</label>
                        <textarea name="reason" class="form-control shadow-none" rows="3"></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Image:</label>
                        <input type="file" name="image" class="form-control shadow-none" accept=".jpg, .png, .webp, .jpeg" required>
                      </div>
                      <div class="mb-3">
                        <label  class="form-label">Findings:</label>
                        <textarea name="findings" class="form-control shadow-none" rows="3"></textarea>
                      </div>
                      <div class="mb-3">
                        <label  class="form-label">Recommendations:</label>
                        <textarea name="recommendations" class="form-control shadow-none" rows="3"></textarea>
                      </div>
                      <input type="text" name ="patient_id" value ="<?php echo $pdata['id'];?>" hidden>
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
  <script src= "script/test_report.js"></script>
  
  <?php require('partials/scripts.php'); ?>
</body>
</html>