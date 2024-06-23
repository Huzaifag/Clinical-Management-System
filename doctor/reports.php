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
  <title>Admin Panel- Reports</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4">
    <h3 class="mb-4">Generate Reports</h3>

<!-- Query Data Table -->
<div class="card border-0 shadow-sm mb-4 alert alert-success">
  <div class="card-body">
    <div class="d-flex justify-content-end mb-3">
      <form id="search_form" class="d-flex">
        <input type="text" class="form-control shadow-none" id= "search_inp" name="search_inp" placeholder="Search Patient">
        <button style= 'width: 130px' type="button" class=" mx-2 btn btn-outline-primary btn-sm shadow-none" onclick="search_patients()">
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
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id = "patients-data" class="text-center">

        </tbody>
      </table>
    </div>
  </div>

    </div>
  </div>
  </div>
  <?php require('partials/scripts.php');?>
  <script>

    function get_patients(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/get_patients.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
        document.getElementById('patients-data').innerHTML = this.responseText;
    };
    xhr.send('get_patients');
    }

 
    
  

  function search_patients(){
    let search_inp = document.getElementById('search_inp');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/get_patients.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
        document.getElementById('patients-data').innerHTML = this.responseText;
    };
    xhr.send('search_patients=' + search_inp.value );
  }

  let search_form = document.getElementById('search_form');
  search_form.addEventListener("keydown", function(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
      event.preventDefault(); // Prevent default action only for Enter key
      search_patients(); // Execute your desired action here
  }
  });



window.onload = function(){
  get_patients();
}




  </script>
</body>
</html>