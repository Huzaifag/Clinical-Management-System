<?php
require("partials/essentials.php");
require("partials/db_config.php");
adminLogin();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel- Inventory</title>
  <?php require('partials/links.php');?>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>

  <div class="container-fluid" id="menu-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        <div class="container-fluid">
          <div class="row">
            <h4 class="alert-heading">Inventory</h4>
            <p class="mb-0">View and manage clinic Inventory here.</p>
            <div class="alert alert-success mt-3  shadow-sm" role="alert">
              <div class="search_inventory d-flex justify-content-between">
                <form class="d-flex align-items-center">
                  <select class="form-select shadow-none" id="search_categories">
                    <option selected>Select Category</option>
                    <option value="Medical Consumables">Medical Consumables</option>
                    <option value="Diagnostic Equipment">Diagnostic Equipment</option>
                    <option value="Medications and Vaccines">Medications and Vaccines</option>
                    <option value="Medical Furniture">Medical Furniture</option>
                    <option value="Lab and Testing Supplies">Lab and Testing Supplies</option>
                    <option value="Office and Administrative Supplies">Office and Administrative Supplies</option>
                    <option value="Infection Control and Cleaning Supplies">Infection Control and Cleaning Supplies</option>
                    <option value="Patient Comfort and Care Items">Patient Comfort and Care Items</option>
                  </select>
                  <button class="btn btn-outline-primary shadow-none ms-1" style="width: 130px;" onclick = "search()" type="button">
                    <i class="bi bi-search"></i> Search
                  </button>
                </form>
                  <button class="btn btn-outline-secondary shadow-none ms-2" style="width: 130px;"data-bs-toggle="modal" data-bs-target="#add_modal">
                    <i class="bi bi-plus-square-fill"></i> Add Item
                  </button>
              </div>
              <div class="table-responsive-md mt-2" class="table-responsive-md" style="height: 500px; overflow-y: scroll;" id="style-4">
                <table class="table table-hover table-bordered border-info">
                  <thead class="sticky-top">
                    <tr class="bg-info text-white text-center">
                      <th scope="col">#</th>
                      <th scope="col">Item Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Category</th>
                      <th scope="col"style ="width : 20%">Expiration Data</th>
                      <th scope="col" style ="width : 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody id="inventory_data">
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add inventory Modal -->
<div class="modal fade" id="add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add new Inventroy Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add_form">
          <div class="mb-3">
            <label class="form-label">Item Name:</label>
            <input type="text" class="form-control shadow-none" name ="iName">
          </div>
          <div class="mb-3">
            <label class="form-label">Description:</label>
            <input type="text" class="form-control shadow-none" name ="iDescription">
          </div>
          <div class="mb-3">
            <label class="form-label">Quantity:</label>
            <input type="number" class="form-control shadow-none" name ="iquantity">
          </div>
          <div class="mb-3">
            <label class="form-label">Category:</label>
            <select class="form-select shadow-none" name="category">
              <option selected>Select Category</option>
              <option value="Medical Consumables">Medical Consumables</option>
              <option value="Diagnostic Equipment">Diagnostic Equipment</option>
              <option value="Medications and Vaccines">Medications and Vaccines</option>
              <option value="Medical Furniture">Medical Furniture</option>
              <option value="Lab and Testing Supplies">Lab and Testing Supplies</option>
              <option value="Office and Administrative Supplies">Office and Administrative Supplies</option>
              <option value="Infection Control and Cleaning Supplies">Infection Control and Cleaning Supplies</option>
              <option value="Patient Comfort and Care Items">Patient Comfort and Care Items</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Expiration Data:</label>
            <input type="date" class="form-control shadow-none" name ="ex_data">
          </div>
        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary shadow-none">save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit inventory Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Inventroy Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="edit_form">
        <input type="text" class="form-control shadow-none" name ="inventory_id" hidden>
          <div class="mb-3">
            <label class="form-label">Item Name:</label>
            <input type="text" class="form-control shadow-none" name ="iName_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Description:</label>
            <input type="text" class="form-control shadow-none" name ="iDescription_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Quantity:</label>
            <input type="number" class="form-control shadow-none" name ="iquantity_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Category:</label>
            <select class="form-select shadow-none" name="category_edit">
              <option selected>Select Category</option>
              <option value="Medical Consumables">Medical Consumables</option>
              <option value="Diagnostic Equipment">Diagnostic Equipment</option>
              <option value="Medications and Vaccines">Medications and Vaccines</option>
              <option value="Medical Furniture">Medical Furniture</option>
              <option value="Lab and Testing Supplies">Lab and Testing Supplies</option>
              <option value="Office and Administrative Supplies">Office and Administrative Supplies</option>
              <option value="Infection Control and Cleaning Supplies">Infection Control and Cleaning Supplies</option>
              <option value="Patient Comfort and Care Items">Patient Comfort and Care Items</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Expiration Data:</label>
            <input type="date" class="form-control shadow-none" name ="ex_data_edit">
          </div>
        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary shadow-none">save</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <?php require('partials/scripts.php');?>
  
<script src="scripts/inventory.js"></script>
</body>
</html>

