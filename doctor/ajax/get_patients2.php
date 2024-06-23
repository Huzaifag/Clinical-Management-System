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
      <td>$row[gender]</td>
      <td><a href="patient_reports.php?pid=$row[id]" class="btn btn-sm btn-success"><i class="bi bi-eye me-1"></i>View</a>
      <button onclick="delete_patient($row[id])" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i></button>
      </td>
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
      <td>$row[gender]</td>
      <td><a href="patient_details.php?pid=$row[id]" class="btn btn-sm btn-success"><i class="bi bi-eye me-1"></i>View</a>
      <button onclick="delete_patient($row[id])" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i></button>
      </td>
    </tr>
html;
    $sr+= 1;
  }
}

if(isset($_POST['delete_patient'])){
  // Sanitize input
  $frm_data = filteration($_POST); // Assuming filteration function exists

  $pid = $frm_data['delete_patient'];
  $q = "UPDATE `patient` SET `status`= ? WHERE `id` = ?";
  $values = [0, $pid];
  $res = update($q, $values, 'ii');
  if($res){
    echo 1;
  }
  else{
    echo 0;
  }
}
?>