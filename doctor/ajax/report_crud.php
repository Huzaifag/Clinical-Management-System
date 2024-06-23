<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin(); // Assuming this function starts the session

$doctor_id = $_SESSION['doctorId'];
$doctor_name = $_SESSION['doctorname'];

if(isset($_POST['add_report'])){
  // JSON decode the symptoms sent via POST
  $symptoms = json_decode($_POST['symptoms']);
  // Filter and sanitize the form data
  $frm_data = filteration($_POST); // function for filtering/sanitizing input

  $flag = 0;
 
  $q1 = "INSERT INTO `reports`(`bp`, `b_sugar`, `temp`, `pulse`, `height`, `weight`, `chief_complaint`, `medical_prescription`,`doctor_id`, `patient_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
  $values = [
    $frm_data['bp'],
    $frm_data['b_sugar'],
    $frm_data['temp'],
    $frm_data['pulse'],
    $frm_data['height'],
    $frm_data['weight'],
    $frm_data['chief_complaint'],
    $frm_data['medical_prescription'],
    $_SESSION['doctorId'], // Using consistent session variable
    $frm_data['patient_id']
  ]; 

  if(insert($q1,$values,'ddddddssii')){
      $flag = 1;
  } else {
      // Handle query error here
      die('Insert query failed for reports table');
  }

  $symptom_id = mysqli_insert_id($con); // Assuming $con is your database connection

  $q2 = "INSERT INTO `report_symptoms`(`report_id`, `symptom_id`) VALUES (?,?)";
  // Prepared statement for facilities
  if($stmt = mysqli_prepare($con,$q2)){
      foreach ($symptoms as $s) {
          mysqli_stmt_bind_param($stmt, 'ii', $symptom_id, $s);
          mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
  } else {
      // Handle query preparation error
      die('Query not Prepared - insert q2');
  }

  if($flag){
      echo 1;
  } else {
      echo 0;
  }
}

if(isset($_POST['get_reports'])){
    $q = "SELECT * FROM `reports` WHERE `patient_id` = ? AND `doctor_id` = ?";
    $values = [$_POST['get_reports'], $doctor_id];
    $result = select($q, $values, 'ii');
    $sr = 1;
    while($rdata = mysqli_fetch_assoc($result)){
        echo <<<report
            <tr>
                <td>$sr</td>
                <td>{$rdata['bp']} (mmHg)</td>
                <td>{$rdata['b_sugar']} (mg/dL)</td>
                <td>{$rdata['temp']} (°C)</td>
                <td>{$rdata['weight']} (Kg)</td>
                <td>{$rdata['date']}</td>
                <td>
                    <button class="btn btn-danger btn-sm me-1" onclick="rem_report({$rdata['id']})">Delete</button>
                    <a class="btn btn-success btn-sm" href="report_detail.php?report_id={$rdata['id']}" target="_blank">View</a>

                </td>
            </tr>
        report;
        $sr++;
    }
}

if(isset($_POST['rem_report'])) {
    $report_id = $_POST['rem_report'];
    $flag = 0;

    // First DELETE query
    $q1 = "DELETE FROM `report_symptoms` WHERE `report_id` = ?";
    $values = [$report_id];
    $result1 = delete($q1, $values, 'i'); // Assuming you have a delete function similar to the select function

    
    if($result1) {
        $flag = 1; 
    } else {
        $flag = 0; 
    }

    // Second DELETE query
    $q2 = "DELETE FROM `reports` WHERE `id` = ?";
    $values = [$report_id];
    $result2 = delete($q2, $values, 'i');  

    if($result2) {
        $flag = 1; 
    } else {
        $flag = 0; 
    }

    echo $flag;
}
if(isset($_POST['get_symptoms'])){
    $frm_data = filteration($_POST);
    $res2 = select("SELECT * FROM `report_symptoms` WHERE `report_id` = ?", [$frm_data["get_symptoms"]], 'i');

    $symptoms = [];
    if(mysqli_num_rows($res2) > 0){
        while($row = mysqli_fetch_assoc($res2)){
            array_push($symptoms, $row['symptom_id']);
        }
    }

    $data = ['symptoms' => $symptoms]; // Corrected variable name
    echo json_encode($data);
}



?>
