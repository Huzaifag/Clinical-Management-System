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
    <!-- Modal -->
    <div class="modal fade" id="bill_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="bill_from">
              <div class="mb-3">
                <label class="form-label">Doctor Fees:</label>
                <input type="number" class="form-control shadow-none" name="docFee" id="docFee">
              </div>
              <div class="mb-3">
                <label class="form-label">Madicine:</label>
                <input type="number" class="form-control shadow-none" name="mad" id="mad">
              </div>
              <div class="mb-3">
                <label class="form-label">Lab Test:</label>
                <input type="number" class="form-control shadow-none" name="lab" id="lab">
              </div>
              <div class="mb-3">
                <label class="form-label">Total:</label>
                <input type="number" class="form-control shadow-none" name="total" id="total">
              </div>
              <input type="hidden" name="patient_id" id="patient_id">
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
  <?php require('partials/scripts.php');?>
  <script>
    let form = document.getElementById('bill_from');
    function get_patients(){
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/get_patientsForBills.php", true);
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
      xhr.open("POST", "ajax/get_patientsForBills.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function(){
        // console.log(this.responseText);
          document.getElementById('patients-data').innerHTML = this.responseText;
      };
      xhr.send('search_patients=' + search_inp.value );
    }
    function new_bill(val){
      const id_input = document.getElementById('patient_id');
      id_input.value = val;
    }
    form.addEventListener('submit', function(e){
      e.preventDefault();
      add_bill();
    });

    function add_bill(){
      let data = new FormData();
      data.append('add_bill', '');
      data.append('docFee', form.elements['docFee'].value);
      data.append('mad', form.elements['mad'].value);
      data.append('lab', form.elements['lab'].value);
      data.append('total', form.elements['total'].value);
      data.append('patient_id', form.elements['patient_id'].value);
  
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/bill_crud.php", true);
      xhr.onload = function() {
        if(xhr.responseText == 1){
          var modalEl = document.getElementById('bill_modal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
          alert('success', 'New bill has been added');
          form.reset();

        }
        else{
          alert('error', 'Something went wrong');
        }
        
      }
      xhr.send(data);
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


    form.addEventListener('input', calculateTotal);

    function calculateTotal() {
      let doctorFee = parseFloat(form.elements['docFee'].value) || 0;
      let madicine = parseFloat(form.elements['mad'].value) || 0;
      let lab = parseFloat(form.elements['lab'].value) || 0;
      let total = doctorFee + lab + madicine;
      form.elements['total'].value = total;
      console.log(total);
    }

    




  </script>
</body>
</html>