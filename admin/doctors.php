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
  <title>Admin Panel- Manage Doctors</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 bg-light" id="alert_div">
      <!-- Doctors Management  -->
     <h2 class="mb-3">Doctors Management</h2>

    <div class="alert alert-success shadow" role="alert">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-4">
          
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title m-0">Manage Doctors</h5>
      <button class="btn btn-sm btn-info fs-5 shadow-none" data-bs-toggle="modal" data-bs-target="#doctors-s"> 
            <i class="bi bi-pencil-square"></i>
          </button>
      </div>
      <div class="table-responsive-md" style="min-height: 450px; min-width: 100%;" id="style-4">
                        <table class="table table-hover border" >
                            <!-- Table Header -->
                            <thead>
                                <tr class="bg-info text-white text-center">
                                    <th scope="col">sr_no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Specialization</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col" width="20%">Date of Join</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Consultation Fee</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody id="doctors_data"></tbody>
                        </table>
                    </div>
     </div>

     <!-- Doctors Modal -->
<div class="modal fade" id="doctors-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="doctors_s_form">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Doctors</h5>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Name</label>
                  <input type="text" class="form-control shadow-none" name="name" id="name_input" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Picture</label>
                  <input type="file" class="form-control shadow-none" name="doctor_picture" accept=".jpg, .png, .webp, .jpeg" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Email</label>
                  <input type="email" class="form-control shadow-none" name="email" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Specialization</label>
                  <input type="text" class="form-control shadow-none" name="specialization" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Phone</label>
                  <input type="number" class="form-control shadow-none" name="pn" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Date of Join</label>
                  <input type="date" class="form-control shadow-none" name="date" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Address</label>
                  <textarea class="form-control shadow-none" name="address" style="min-height: 30px" required></textarea>           
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Consultation Fee</label>
                  <input type="number" class="form-control shadow-none" name="fee" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Password</label>
                  <input type="password" class="form-control shadow-none" name="pass" required>
                </div>
              </div>
              <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label fw-bold">Confirm Password</label>
                  <input type="password" class="form-control shadow-none" name="cpass" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal" onclick="contact_input(contacts_data)">Cancel</button>
          <button type="submit" class="btn custom-bg text-white shadow-none" id="hide">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>



   </div>
  </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script src="scripts/doctors.js"></script>
</body>
</html>