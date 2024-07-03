<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin();
// session_start();
$doctor_id = $_SESSION['doctorId'];
$doctor_name = $_SESSION['doctorname'];


if(isset($_POST['get_appointments'])){
  $action = '';
  $status = '';
  $sr = 1;
  $q1 = "SELECT * FROM `appointments` WHERE `doctor_id` = ? ORDER BY `appointments`.`date` DESC";
  $val1 = [$doctor_id];
  $r1 = select($q1, $val1, 'i');
  

  while($row = mysqli_fetch_assoc($r1)){
    $time =  date("h:i A", strtotime($row['time']));
    if($row['status']== 0){
      $action = '<button class="btn btn-primary btn-sm text-white" onclick="manage('.$row['id'].', 1)">
      Accept
      </button>';
    }
    else{
      $action = '<button class="btn btn-dark btn-sm text-white" onclick="manage('.$row['id'].', 0)">
      reject
      </button>';
    }
    $q2 = "SELECT * FROM `patient` WHERE `id` = ?";
    $values = [$row['patient_id']];
    $r2 = select($q2, $values, 'i');
    $patient_data = mysqli_fetch_assoc($r2);
    $patient_name = $patient_data['name'];
    $patient_phone = $patient_data['pn'];
    if($patient_data['status']== 0){
      $status = '<button class="btn btn-danger btn-sm text-white" onclick="admit('.$patient_data['id'].', 1)">
      Admit
      </button>';
    }
    else{
      $status = '<span class="badge bg-light text-dark">Admitted</span>';
    }

    echo <<<html
    <tr>
      <td>$sr</td>
      <td>$patient_name</td>
      <td>0$patient_phone</td>
      <td>{$row['date']}</td>
      <td>$time</td>
      <td>$action</td>
      <td>$status</td>
    </tr>
    html;
    $sr+= 1;
    
  }
}

if(isset($_POST['manage'])){
  $frm_data = filteration($_POST);
  $q = "UPDATE `appointments` SET `status` = ? WHERE `id` = ?";
  $values = [$frm_data['value'], $frm_data['appointment_id']];
  $res = update($q, $values, 'ii');

  if($res){
    echo 1;
  }
  else{
    echo 0;
  }
}

if(isset($_POST['admit'])){
  $flag = 1; // Set flag to 1 initially

  $frm_data = filteration($_POST);
  $q = "UPDATE `patient` SET `status` = ? WHERE `id` = ?";
  $values = [$frm_data['value'], $frm_data['patient_id']];
  $res = update($q, $values, 'ii');

  if(!$res){ // If update operation fails
    $flag = 0; // Set flag to 0
  }

  $q2 = "INSERT INTO `doctor_patients`(`doctor_id`, `patient_id`) VALUES (?,?)";
  $values2 = [$doctor_id, $frm_data['patient_id']];
  $res2 = insert($q2, $values2, 'ii');

  if(!$res2){ // If insert operation fails
    $flag = 0; // Set flag to 0
  }

  echo $flag;
}



?>