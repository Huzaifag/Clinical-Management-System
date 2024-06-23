<?php
require("../partials/essentials.php");
require("../partials/db_config.php");

// Ensure user is logged in as admin
adminLogin();
session_regenerate_id(true);

if(isset($_GET['del_id'])){
  $del_id = $_GET['del_id'];

  // Delete query to delete bill based on bill_id
  $sql_delete = "DELETE FROM `bills` WHERE `bill_id` = ?";
  $val_delete = [$del_id];
  $res_delete = delete($sql_delete, $val_delete, 'i');

  // Check if delete was successful and provide feedback
  if($res_delete){
    alert('success', 'Bill has been successfully deleted.');
    redirect('../bill_list.php'); // Redirect to bill list page after deletion
  }
  else{
    alert('error', 'Failed to delete bill.');
  }
}
?>
