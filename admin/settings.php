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
  <title>Admin Panel- Settings</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 bg-light" id="alert_div">
      <!-- General Settings  -->
     <h2 class="mb-3">Settings</h2>

     <div class="alert alert-success shadow" role="alert">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-4">
          <h4>General Settings</h4>
        </div>
        <div class="col-lg-4 text-end">
          <button class="btn btn-sm btn-info fs-5 shadow-none" data-bs-toggle="modal" data-bs-target="#general-s"> 
            <i class="bi bi-pencil-square"></i>
          </button>
        </div>
      </div>

      <div class="mb-3">
      <h6 class="card-subtitle mb-1 fw-bold">Site title</h6>
          <p class="card-text" id="site_title"></p>
          <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
          <p class="card-text" id="site_about"></p>
      </div>

     </div>

       <!-- General Settings Modal -->
  <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="general_s_form">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">General Settings</h5>
        </div>
        <div class="modal-body">
        <div class="mb-3">
          <label class="form-label fw-bold">Site Title</label>
          <input type="text" class="form-control shadow-none" name="site_title" id="site_title_input" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label fw-bold">About us</label>
          <textarea class="form-control shadow-none" name="about_us" rows="6" id="site_about_input" required></textarea>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal" onclick="site_title.value = general_data.site_title, about_us.value = general_data.about_us">Cancel</button>
          <button type="submit" class="btn custom-bg text-white shadow-none" id="hide">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <!-- Shutdown Website  -->

  <div class="alert alert-success shadow mt-4" role="alert">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="card-title m-0">Shutdown Website</h4>
      <div class="form-check form-switch">
        <form>
          <input onchange="upd_shutdown(this.value)" class="form-check-input shadow-none" type="checkbox" id="shutdown_toggle">
        </form>
      </div>
    </div> 
    <p class="card-text">No patient will be allowed to book the appointment when Shutdown mode is turned on.</p>
  </div>
  </div>

  <!-- Setting schedule  -->

  <div class="alert alert-success shadow mt-4" role="alert">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="card-title m-0">Clinic Opening & Closing</h4>
    </div> 
    <table class="table">
  <thead class="bg-info text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Day</th>
      <th scope="col">Open</th>
      <th scope="col">Close</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id ="time_data">
   
  </tbody>
</table>
  </div>
  </div>


<!-- schedule modal  -->

<div class="modal fade" id="schedule-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="schedule_s_form">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Schedule</h4>
        </div>
        <div class="modal-body">
        <div class="mb-3">
          <label class="form-label fw-bold">Opening Time:</label>
          <input type="time" class="form-control shadow-none" name="opening_time" id="opening_time_input">
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold">Closing Time:</label>
          <input type="time" class="form-control shadow-none" name="closing_time" id="closing_time_input">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_closed" id="is_closed">
          <label class="form-check-label">
            Clinic Closed
          </label>
        </div>
        <input type="hidden" name="schedule_id" id="schedule_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn custom-bg text-white shadow-none" id="hide">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div>


     <div class="alert alert-success shadow" role="alert">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-4">
        <h4 class="card-title m-0 mb-3">Contact Settings</h4>
        </div>
        <div class="col-lg-4 text-end">
          <button class="btn btn-sm btn-info fs-5 shadow-none" data-bs-toggle="modal" data-bs-target="#contact-s"> 
            <i class="bi bi-pencil-square"></i>
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-1">Address</h6>
            <p class="card-text" id="address"></p>
          </div>
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-1">Google Map Link</h6>
            <p class="card-text" id="gmap"></p>
          </div>
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-2">Phone Numbers</h6>
            <p class="card-text">
              <i class="bi bi-telephone-fill"></i><span id="phone1"></span>
            </p>
            <p class="card-text">
              <i class="bi bi-telephone-fill"></i><span id="phone2"></span>
            </p>
          </div>
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-1">E-mail</h6>
            <p class="card-text" id="email"></p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-2">Social Links</h6>
            <p class="card-text m-0 mb-1">
              <i class="bi bi-facebook me-1"></i><span id="fb"></span>
            </p>
            <p class="card-text m-0 mb-1">
              <i class="bi bi-instagram me-1"></i><span id="insta"></span>
            </p>
            <p class="card-text m-0 mb-1">
              <i class="bi bi-twitter-x me-1"></i><span id="tw"></span>
            </p>
          </div>
          <div class="mb-4">
            <h6 class="card-subtitle fw-bold mb-2">iFrame</h6>
            <iframe loading="lazy" class="border p-2 w-100" id="iframe">

            </iframe>
          </div>
        </div>
      </div>

      <!-- Contact us Modal -->
  <div class="modal fade" id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="contact_s_form">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contacts Settings</h5>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Address</label>
                  <input type="text" class="form-control shadow-none" name="address" id="address_input" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Google Map Link</label>
                  <input type="text" class="form-control shadow-none" name="gmap" id="gmap_input" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Phone</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <i class="bi bi-telephone-fill"></i>
                    </span>
                    <input type="number" class="form-control shadow-none" name="phone1" id="phone1_input" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <i class="bi bi-telephone-fill"></i>
                    </span>
                    <input type="number" class="form-control shadow-none" name="phone2" id="phone2_input">
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Email</label>
                  <input type="text" class="form-control shadow-none" name="email" id="email_input" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Social Media Links</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <i class="bi bi-facebook"></i>
                    </span>
                    <input type="text" class="form-control shadow-none" name="fb" id="fb_input" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <i class="bi bi-instagram"></i>
                    </span>
                    <input type="text" class="form-control shadow-none" name="insta" id="insta_input" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <i class="bi bi-twitter-x"></i>
                    </span>
                    <input type="text" class="form-control shadow-none" name="tw" id="tw_input" >
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">iFrame</label>
                  <textarea class="form-control shadow-none" id="iframe_input" name="iframe" style="min-height: 200px" required></textarea>           
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
  </div>
  <?php require('partials/scripts.php');?>
  <script src="scripts/settings.js"></script>
</body>
</html>