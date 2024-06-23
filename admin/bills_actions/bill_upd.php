<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();
session_regenerate_id(true);
?>
<?php
if(isset($_GET['pay_id'])){
  $pay_id = $_GET['pay_id'];
  $val = 0; // Initialize $val variable

  // Select query to fetch bill data
  $sql_select = "SELECT * FROM `bills` WHERE `bill_id` = ?";
  $val_select = [$pay_id];
  $res_select = select($sql_select, $val_select, 'i');
  $billData = mysqli_fetch_assoc($res_select);

  // Update $val based on current status
  if($billData['status'] == 0){
    $val = 1; // Set $val to 1 if status is currently 0 (unpaid)
  }

  // Update query to update bill status
  $sql_update = "UPDATE `bills` SET `status`= ? WHERE `bill_id` = ?";
  $val_update = [$val, $billData['bill_id']];
  $res_update = update($sql_update, $val_update, 'ii');

  // Check if update was successful and provide feedback
  if($res_update){
    alert('sucess', 'changes have been made');
    redirect('../bill_list.php');
  }
  else{
    alert('error', 'changes have not been made');
  }
}
?>