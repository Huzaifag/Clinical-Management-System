<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();

if(isset($_POST['get_general'])){
    $q = "SELECT * FROM `generals` WHERE `id` = ?";
    $value = [1];
    $res = select($q,$value,"i");
    if($res) {
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    } else {
        echo "Error: Unable to fetch general settings.";
    }
}

if(isset($_POST['upd_general'])){
  $frm_data = filteration($_POST);
  $q = "UPDATE `generals` SET `site_title`=?,`about_us`=? WHERE `id`=?";
  $values = [$frm_data['site_title'], $frm_data['site_about'], 1] ;
  $res = update($q,$values,'ssi');
  if($res) {
      echo $res;
  } else {
      echo "Error: Unable to update general settings.";
  }
}

if(isset($_POST['upd_shutdown'])){
    $temp = 0;
 if($_POST['upd_shutdown'] == 0){
        $frm_data = 1;
        $temp = 1;
    } else {
        $frm_data = 0;
        $temp = 0;
    }
    $q = "UPDATE `generals` SET `shutdown`=? WHERE `id`=?";
    $values = [$frm_data, 1];
    $res = update($q, $values, 'ii');
    if($res) {
        echo $temp;
    } else {
        echo "Error: Unable to update general settings.";
    }
}

if(isset($_POST['get_schedule'])){
    $res = selectAll('schedule');
    $status = '';
    $temp = 1; // Initialize counter
    while($row = mysqli_fetch_assoc($res)){
        $open = date("h:i A", strtotime($row['open']));
        $close = date("h:i A", strtotime($row['close']));
        if($row['status'] == 1) {
           $status = 'Emergency only';
           $open =  '00 : 00';
           $close =  '00 : 00';
        }else{
            $status = 'Open for all';
        }  // Reset status for each iteration
        echo <<<html
        <tr>
            <td>$temp</td>
            <td>$row[day]</td>
            <td>$open</td>
            <td>$close</td>
            <td>$status</td>
            <td><button type="button" onclick="upd_schd($row[id])" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#schedule-s"></i></button></td>
        </tr>
        html;
        $temp++; // Increment counter
    }
}

if(isset($_POST['upd_schedule'])){
   $form_data = filteration($_POST);

    $q = "UPDATE `schedule` SET `open`=?,`close`=?,`status`=? WHERE `id`= ?";
    $values = [$form_data['opening_time'], $form_data['closing_time'], $form_data['is_closed'], $form_data['schedule_id']];

    $res = update($q, $values, 'ssii');

    if($res){
        echo $res;
    }
    else{
        echo "Query failed.";
    }

}

if(isset($_POST['get_contact'])){
    $q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
    $value = [1];
    $res = select($q,$value,"i");
    if($res) {
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    } else {
        echo "Error: Unable to fetch general settings.";
    }
}

if(isset($_POST['udp_contacts'])){
    $frm_data = filteration($_POST);
    $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `sr_no`=?";
    $values = [$frm_data['address'], $frm_data['gmap'],$frm_data['phone1'],$frm_data['phone2'],$frm_data['email'],$frm_data['fb'],$frm_data['insta'],$frm_data['tw'],$frm_data['iframe'], 1];
    $res = update($q,$values,'ssiisssssi');
    if($res !== false) {
        echo 1;
    } else {
        echo "Error: Unable to update contact details.";
    }
}



?>