<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin(); 
if(isset($_POST['userId'])){
  $userId = $_POST['userId'];
  $sql = "SELECT * FROM `doctor` WHERE `id` = ? ";
  $values = [$userId];
  $result = select($sql, $values, 'i');
  $data = mysqli_fetch_assoc($result);
  echo json_encode($data);
}

if(isset($_POST['doctorId'])){
  $formData = filteration($_POST);
  $sql = "UPDATE `doctor` SET `name`=?,`email`=?,`pn`=?,`address`=?,`Specialization`= ?,`fees`=? WHERE `id`= ?";
  $values = [$formData['name'], $formData['email'], $formData['phone'], $formData['address'], $formData['specialization'], $formData['fees'],$formData['doctorId']];
  $result = update($sql, $values, 'ssissii');
  if($result){
    echo 1;
  }else{
    echo 'Something went wrong...';
  }
}
?>