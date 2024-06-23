<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();

if(isset($_POST['get_inventory'])){
  $res = selectAll('inventory');
  $i = 1;
  while($data = mysqli_fetch_assoc($res)){
    $expiration_date = '';
    if($data['expiration_data'] == '0000-00-00'){
      $expiration_date = 'N/A';
    }
    else{
      $expiration_date = date('d-m-Y', strtotime($data['expiration_data']));
    }
    echo <<<html
      <tr class="text-center">
        <td>$i</td>
        <td>$data[item_name]</td>
        <td>$data[description]</td>
        <td>$data[quantity]</td>
        <td>$data[category]</td>
        <td>$expiration_date</td>
        <td>
          <button class="btn btn-success btn-sm shadow-none me-1" onclick="edit($data[inventory_id])" data-bs-toggle="modal" data-bs-target="#edit_modal">
            <i class="bi bi-pencil-square"></i>
          </button>
          <button class="btn btn-success btn-sm shadow-none me-1" onclick="del_inventory($data[inventory_id])">
            <i class="bi bi-trash-fill"></i>
          </button>
        </td>
      </tr>
    html;
    $i++;
  }
}

if(isset($_POST['add_inventory'])){
    $frm_data = filteration($_POST);
    
    $query = "INSERT INTO `inventory`(`item_name`, `description`, `quantity`, `category`, `expiration_data`) VALUES (?,?,?,?,?)";
    
    $values = [$frm_data['iName'],$frm_data['iDescription'],$frm_data['iquantity'],$frm_data['category'],$frm_data['ex_data']];
    $res = insert($query, $values, 'ssiss');

    if($res){
      echo $res; // Assuming $res contains '1' on success
    }
    else{
      echo "Failed to add inventory";
    }
}

if(isset($_POST['del_inventory'])){
  $frm_data = filteration($_POST);
  
  $query = "DELETE FROM `inventory` WHERE `inventory_id`= ?";
  
  $values = [$frm_data['del_inventory']];
  $res = insert($query, $values, 'i');

  if($res){
    echo $res; // Assuming $res contains '1' on success
  }
  else{
    echo "Failed to delete item from Inventory";
  }
}

if(isset($_POST['edit_inventory'])){
  $frm_data = filteration($_POST);
  $query = "SELECT * FROM `inventory` WHERE `inventory_id` = ?";
  $values = [$frm_data['edit_inventory']];
  $res = select($query, $values, 'i');

  $data = mysqli_fetch_assoc($res);

  echo json_encode($data);
}

if(isset($_POST['update_inventory'])){
  $frm_data = filteration($_POST);
  
  $query = "UPDATE `inventory` SET `item_name`=?,`description`=?,`quantity`=?,`category`=?,`expiration_data`=? WHERE `inventory_id` = ?";
  $values = [$frm_data['iName_edit'], $frm_data['iDescription_edit'], $frm_data['iquantity_edit'], $frm_data['category_edit'], $frm_data['ex_data_edit'], $frm_data['inventory_id']];
  $res = insert($query, $values, 'ssissi');

  if($res){
    echo $res; // Assuming $res contains '1' on success
  }
  else{
    echo "Failed to add inventory";
  }
}

if(isset($_POST['search_inventory'])){
  $search_term = $_POST['search_inventory'];
    $q = "SELECT * FROM inventory WHERE category LIKE ?;";
    $values = ["$search_term%"]; 
    $res = select($q, $values, 's');
    $i = 1;
  while($data = mysqli_fetch_assoc($res)){
    $expiration_date = '';
    if($data['expiration_data'] == '0000-00-00'){
      $expiration_date = 'N/A';
    }
    else{
      $expiration_date = date('d-m-Y', strtotime($data['expiration_data']));
    }
    echo <<<html
      <tr class="text-center">
        <td>$i</td>
        <td>$data[item_name]</td>
        <td>$data[description]</td>
        <td>$data[quantity]</td>
        <td>$data[category]</td>
        <td>$expiration_date</td>
        <td>
          <button class="btn btn-success btn-sm shadow-none me-1" onclick="edit($data[inventory_id])" data-bs-toggle="modal" data-bs-target="#edit_modal">
            <i class="bi bi-pencil-square"></i>
          </button>
          <button class="btn btn-success btn-sm shadow-none me-1" onclick="del_inventory($data[inventory_id])">
            <i class="bi bi-trash-fill"></i>
          </button>
        </td>
      </tr>
    html;
    $i++;
  }
}


?>
