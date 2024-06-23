<?php
require("partials/essentials.php");

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
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4">
    <h3 class="mb-4">Appointments</h3>

<!-- Query Data Table -->
<div class="card border-0 shadow-sm mb-4 alert alert-success">
  <div class="card-body">
    <div class="d-flex justify-content-end mb-3">
      <form id="search_form" class="d-flex">
        <input type="date" class="form-control shadow-none" name="search_inp" placeholder="Search Patient">
        <button style= 'width: 130px' type="button" class=" mx-2 btn btn-outline-primary btn-sm shadow-none">
          <i class="bi bi-search me-1"></i>Search
        </button>
      </form>
    </div>
    <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;" id="style-4">
      <table class="table table-hover border">
        <thead class="sticky-top">
          <tr class="bg-info text-white text-center">
            <th scope="col">Sr</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Date</th>                                       
            <th scope="col">Time</th>
            <th scope="col">Action</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id = "appointments-data" class="text-center">

        </tbody>
      </table>
    </div>
  </div>

    </div>
  </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script>
    function get_appointments(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/appointments_op.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
        document.getElementById('appointments-data').innerHTML = this.responseText;
    };
    xhr.send('get_appointments');
    }

window.onload = function(){
  get_appointments();
}

function manage(appointment_id, val){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/appointments_op.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    // console.log(this.responseText);
    if (this.responseText == 1){
      alert('Changes have been made');
      get_appointments();
    } 
    else{
      alert('Failed to make changes');
    }
  };
  xhr.send('appointment_id='+ appointment_id + '&value=' + val + '&manage');
}

function admit(patient_id, val){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/appointments_op.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    // console.log(this.responseText);
    if (this.responseText == 1){
      alert('Patient has been admitted');
      get_appointments();
    } 
    else{
      alert('Failed to admit patient');
    }
  };
  xhr.send('patient_id=' + patient_id + '&value=' + val + '&admit');
}


  </script>
</body>
</html>