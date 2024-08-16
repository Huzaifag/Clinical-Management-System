<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
patientLogin(); 
if(isset($_POST['userId'])){
  $userId = $_POST['userId'];
  $sql = "SELECT * FROM `patient` WHERE `id` = ? ";
  $values = [$userId];
  $result = select($sql, $values, 'i');
  $data = mysqli_fetch_assoc($result);
  echo json_encode($data);
}

if(isset($_POST['patientId'])){
  $formData = filteration($_POST);
  $sql = "UPDATE `patient` SET `name`=?,`email`=?,`pn`=?,`address`=?,`gender`= ?,`dob`=? WHERE `id`= ?";
  $values = [$formData['name'], $formData['email'], $formData['phone'], $formData['address'], $formData['gender'], $formData['dob'],$formData['patientId']];
  $result = update($sql, $values, 'ssisssi');
  if($result){
    echo 1;
  }else{
    echo 'Something went wrong...';
  }
}
?>