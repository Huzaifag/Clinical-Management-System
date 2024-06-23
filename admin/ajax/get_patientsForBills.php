<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();

if(isset($_POST['get_patients'])){
  $q = "SELECT * FROM `patient` WHERE `status` = ?;";
  $values = [1];
  $res = select($q, $values, 'i');
  $sr = 1;
  while($row = mysqli_fetch_assoc($res)){
    echo <<<HTML
      <tr>
        <td>$sr</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>0{$row['pn']}</td>
        <td>
          <button class="btn btn-sm btn-success shadow-none" onclick="new_bill({$row['id']})" data-bs-toggle="modal" data-bs-target="#bill_modal">
            <i class="bi bi-eye me-1"></i>Generate Bill
          </button>
        </td>
      </tr>
HTML;
    $sr+= 1;
  }
}

if(isset($_POST['search_patients'])){
  $search_term = $_POST['search_patients']; // This could be dynamically set based on user input
    $q = "SELECT * FROM patient WHERE `status` = ? AND name LIKE ?;";
    $values = [1,"$search_term%"]; // Add % to the search term for the wildcard
    $res = select($q, $values, 'is');

  $sr = 1;
  while($row = mysqli_fetch_assoc($res)){
    echo <<<HTML
      <tr>
        <td>$sr</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>0{$row['pn']}</td>
        <td>
          <button class="btn btn-sm btn-success shadow-none" onclick="new_bill({$row['id']})" data-bs-toggle="modal" data-bs-target="#bill_modal">
            <i class="bi bi-eye me-1"></i>Generate Bill
          </button>
        </td>
      </tr>
HTML;
    $sr+= 1;
  }
}


?>