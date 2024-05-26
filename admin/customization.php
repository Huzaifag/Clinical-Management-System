<?php
require("partials/essentials.php");
adminLogin();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel- Customizations</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 bg-light" id="alert_div">
      <!-- Customizations  -->
     <h2 class="mb-3">Customizations</h2>

     <div class="alert alert-success shadow" role="alert">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-4">
          <h4>CAROUSAL</h4>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title m-0">Images</h5>
      <button class="btn btn-sm btn-info fs-5 shadow-none" data-bs-toggle="modal" data-bs-target="#carousal-s"> 
            <i class="bi bi-pencil-square"></i>
          </button>
      </div>
      <div class="row" id="carousal-data">
        
      </div>
     </div>

      <!-- carousal Modal  -->
    <div class="modal fade" id="carousal-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="carousal-s-form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Images</h5>
          </div>
          <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label fw-bold">Picture</label>
            <input type="file" class="form-control shadow-none" name="carousal_picture" id="carousal_picture_input" accept=".jpg, .png, .webp, .jpeg" required>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal" onclick="carousal_picture_input.value = ''">Cancel</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
          </div>
        </div>
        </form>
      </div>
    </div>
   
    </div>

    <div class="alert alert-success shadow" role="alert">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-4">
          <h4>Facilities Section</h4>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title m-0">Images</h5>
      <button class="btn btn-sm btn-info fs-5 shadow-none" data-bs-toggle="modal" data-bs-target="#facility-s"> 
            <i class="bi bi-pencil-square"></i>
          </button>
      </div>
      <div class="table-responsive-md" style="min-height: 450px;" id="style-4">
                        <table class="table table-hover border">
                            <!-- Table Header -->
                            <thead>
                                <tr class="bg-info text-white text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody id="faciltily_data"></tbody>
                        </table>
                    </div>
     </div>

     <!-- facilities Modal  -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <form id="facility-s-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Facility</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control shadow-none" name="facility_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon</label>
                        <input type="file" class="form-control shadow-none" name="facility_icon" accept=".svg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea class="form-control shadow-none" name="facility_description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                </div>
            </div>
        </form>
      </div>
    </div>


   </div>
  </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script src="scripts/customizations.js"></script>
</body>
</html>