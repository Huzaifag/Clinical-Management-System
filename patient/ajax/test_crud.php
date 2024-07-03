<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
doctorLogin(); // Assuming this function starts the session

$doctor_id = $_SESSION['doctorId'];
$doctor_name = $_SESSION['doctorname'];

if(isset($_POST['add_report'])){
    $frm_data = filteration($_POST);
    
    // Check if 'image' is set in $_FILES and it's not empty
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Check if there were any errors during upload
        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Proceed with file upload
            $img_r = uploadImage($_FILES['image'], REPORT_FOLDER);

            // Check if uploadImage() returns null
            if($img_r === null) {
                alert('error', 'An error occurred during image upload.');
            } else {
                // Handle other cases
                if($img_r == 'inv_img'){
                   echo $img_r;
                }
                else if($img_r == 'inv_size'){
                  echo $img_r;
                }
                else if($img_r == 'upload_failed'){
                  echo $img_r;
                }
                else {
                   $query = "INSERT INTO `test_report`(`ex_type`, `probe`, `reason`, `image`, `findings`, `recommendations`, `patient_id`, `doctor_id`) VALUES (?,?,?,?,?,?,?,?)";
                   $values = [$frm_data['ex_type'],$frm_data['probe'],$frm_data['reason'],$img_r,$frm_data['findings'],$frm_data['recommendations'],$frm_data['patient_id'],$doctor_id];
                   $result = insert($query, $values, 'sdssssii');
                   if($result){
                    echo 1;
                   }
                }
            }
        } else {
            alert('error', "No image uploaded or invalid file.");
        }
    }
}

if(isset($_POST['get_reports'])){
    $q = "SELECT * FROM `test_report` WHERE `patient_id` = ? AND `doctor_id` = ?";
    $values = [$_POST['get_reports'], $doctor_id];
    $result = select($q, $values, 'ii');
    $sr = 1;
    while($rdata = mysqli_fetch_assoc($result)){
        echo <<<report
            <tr>
                <td>$sr</td>
                <td>{$rdata['ex_type']}</td>
                <td>{$rdata['probe']} (MHz)</td>
                <td>{$rdata['reason']}</td>
                <td>{$rdata['date']}</td>
                <td>
                    <button class="btn btn-danger btn-sm me-1" onclick="rem_report({$rdata['id']})">Delete</button>
                    <a class="btn btn-success btn-sm" href="test_detail.php?report_id={$rdata['id']}" target="_blank">View</a>

                </td>
            </tr>
        report;
        $sr++;
    }
}

if(isset($_POST['rem_report'])) {

    // Check if report exists
    $pre_q = "SELECT * FROM `test_report` WHERE `id` = ?";
    $res = select($pre_q, [$_POST['rem_report']], 'i');
 
    if($res) {
        if(mysqli_num_rows($res) > 0) {
            // doctor exists, fetch associated icon
            $img = mysqli_fetch_assoc($res);
 
            // Attempt to delete associated icon
            if(deleteImage($img['image'], REPORT_FOLDER)){
                // Icon deleted, now delete report
                $q = "DELETE FROM `test_report` WHERE `id` = ?";
                $res = delete($q, [$_POST['rem_report']], 'i');
 
                // Check if deletion was successful
                if($res) {
                     echo $res;
                } else {
                    echo "Failed to delete report";
                }
            } else {
                echo "Failed to delete image";
            }
        } else {
            echo "report not found";
        }
    } else {
        echo "Error executing database query: " . mysqli_error($connection); // Change $connection to your database connection variable
    }
}

?>
