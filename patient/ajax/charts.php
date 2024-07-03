<?php
require("../partials/db_config.php");
require("../partials/essentials.php");
doctorLogin();
session_regenerate_id(true);

if (isset($_POST['get_appointments'])) {
    $doc_id = $_SESSION['doctorId'];
    $q1 = "SELECT * FROM `appointments` WHERE `doctor_id` = ? ORDER BY `appointments`.`date` DESC";
    $val1 = [$doc_id];
    $r1 = select($q1, $val1, 'i');
    
    $appointments = array();
    while ($row = mysqli_fetch_assoc($r1)) {
        $appointments[] = $row;
    }
    
    echo json_encode($appointments);
}
?>
