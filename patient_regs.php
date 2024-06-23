<?php
require('admin/partials/db_config.php');
require('admin/partials/essentials.php');
if(isset($_POST['add_patient'])){
    $frm_data = filteration($_POST);
    
    // Check if 'image' is set in $_FILES and it's not empty
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Check if there were any errors during upload
        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Proceed with file upload
            $img_r = uploadImage($_FILES['image'], PATIENT_FOLDER);

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
                    $q1 = "SELECT * from  `patient` where `name` = ? AND `email` = ?";
                    $valuesp = [$frm_data['name'], $frm_data['email']];
                    $res = select($q1, $valuesp, 'ss');
                    if(mysqli_num_rows($res) == 1){
                        echo 2;
                    }
                    else {
                        if($frm_data['pass'] == $frm_data['cpass']){
                            $hashedPassword = password_hash($frm_data['pass'], PASSWORD_DEFAULT);
                            $q = "INSERT INTO `patient`(`name`, `email`, `pn`, `image`, `address`, `gender`, `dob`, `password`) VALUES  (?,?,?,?,?,?,?,?)";
                            $values = [$frm_data['name'], $frm_data['email'], $frm_data['pn'], $img_r, $frm_data['address'], $frm_data['gender'], $frm_data['dob'], $hashedPassword];
                            $res = insert($q, $values, 'ssisssss');
                            echo $res;
                        } else {
                            echo 2;
                        }
                    }
                }
            }
        } else {
            alert('error', "No image uploaded or invalid file.");
        }
    }
}
?>