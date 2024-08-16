<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
patientLogin(); 

  session_regenerate_id(true);
  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];

if(isset($_POST['get_symptoms'])){
    $frm_data = filteration($_POST);
    $res2 = select("SELECT * FROM `report_symptoms` WHERE `report_id` = ?", [$frm_data["get_symptoms"]], 'i');

    $symptoms = [];
    if(mysqli_num_rows($res2) > 0){
        while($row = mysqli_fetch_assoc($res2)){
            array_push($symptoms, $row['symptom_id']);
        }
    }

    $data = ['symptoms' => $symptoms]; 
    echo json_encode($data);
}



?>
