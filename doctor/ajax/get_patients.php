<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin();

if(isset($_POST['get_patients'])){
  $q = "SELECT * FROM `patient` WHERE `status` = ?;";
  $values = [1];
  $res = select($q, $values, 'i');
  $sr = 1;
  while($row = mysqli_fetch_assoc($res)){
    echo <<<html
    <tr>
      <td>$sr</td>
      <td>$row[name]</td>
      <td>$row[email]</td>
      <td>0$row[pn]</td>
      <td><a href="patient_reports.php?pid=$row[id]" class="btn btn-sm btn-success"><i class="bi bi-eye me-1"></i>View Reports</a></td>
    </tr>
html;
    $sr+= 1;
  }
}

if(isset($_POST['search_patients'])){
  $search_term = $_POST['search_patients']; // This could be dynamically set based on user input
    $q = "SELECT * FROM patient WHERE name LIKE ?;";
    $values = ["$search_term%"]; // Add % to the search term for the wildcard
    $res = select($q, $values, 's');

  $sr = 1;
  while($row = mysqli_fetch_assoc($res)){
    echo <<<html
    <tr>
      <td>$sr</td>
      <td>$row[name]</td>
      <td>$row[email]</td>
      <td>0$row[pn]</td>
      <td><a href="patient_reports.php?pid=$row[id]" class="btn btn-sm btn-success"><i class="bi bi-eye me-1"></i>View Reports</a></td>
    </tr>
html;
    $sr+= 1;
  }
}


?>