<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();

if(isset($_POST['add_bill'])){
  // Assuming 'filteration' and 'insert' functions are defined elsewhere

  // Filter and sanitize input data
  $frm_data = filteration($_POST);

  // Prepare SQL query to insert data into 'bills' table
  $query = "INSERT INTO `bills`(`doc_fees`, `medicine`, `lab_test`, `total`, `patient_id`) VALUES (?, ?, ?, ?, ?)";
  
  $values = [
    $frm_data['docFee'],
    $frm_data['mad'],
    $frm_data['lab'],
    $frm_data['total'],
    $frm_data['patient_id']
  ];
  $result = insert($query, $values, 'iiiii');

  if($result){
    echo 1; // Success response
  } else {
    echo 0; // Error response
  }
}

?>