<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();


if(isset($_POST['add_doctor'])){
    $frm_data = filteration($_POST);

    // Check if 'picture' is set in $_FILES and it's not empty
    if(isset($_FILES['doctor_picture']) && $_FILES['doctor_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img_r = uploadImage($_FILES['doctor_picture'], DOCTOR_FOLDER);
        
        // Check if uploadImage() returns null
        if($img_r === null) {
            echo "An error occurred during image upload.";
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
            else{
                if($frm_data['pass'] == $frm_data['cpass']){
                    $hashedPassword = password_hash($frm_data['pass'], PASSWORD_DEFAULT);
                    $q = "INSERT INTO `doctor`(`name`, `email`, `image`, `Specialization`, `pn`, `date_of_join`, `address`, `fees`, `password`) VALUES  (?,?,?,?,?,?,?,?,?)";
                    $values = [$frm_data['name'], $frm_data['email'], $img_r, $frm_data['specialization'], $frm_data['pn'], $frm_data['date'], $frm_data['address'], $frm_data['fee'], $hashedPassword];
                    $res = insert($q, $values, 'ssssissis');
                    echo $res;
                } else {
                    echo 2;
                }
            }
        }
    } else {
        echo "No image uploaded or invalid file.";
    }
}


if(isset($_POST['get_doctor'])){
    // $q = "SELECT * FROM `team_details`";
    // $res = mysqli_query($con, $q);
    $res = selectAll('doctor');
    $i = 1;
    $path = DOCTOR_IMAGE_PATH;
    while($row = mysqli_fetch_assoc($res)){
        echo <<<data
        <tr class="text-center align-middle">  
        <td>$i</td>
        <td>{$row['name']}</td>
        <td><img src="{$path}{$row['image']}" alt="{$row['name']}" class="img-fluid" style="width:100px"></td>
        <td>{$row['email']}</td>
        <td>{$row['Specialization']}</td>
        <td>+{$row['pn']}</td>
        <td>{$row['date_of_join']}</td>
        <td>{$row['address']}</td>
        <td>{$row['fees']}</td>
        <td><button type="button" onclick="rem_doctor({$row['id']})" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i> DELETE
            </button></td>
        </tr>
        data;
        $i++;
    }
}

if(isset($_POST['rem_doctor'])){
    // Sanitize input
    $frm_data = filteration($_POST); // Assuming filteration function exists

    // Check if doctor exists
    $pre_q = "DELETE FROM `doctor` WHERE `id` = ?";
    $res = select($pre_q, [$frm_data['rem_doctor']], 'i');

    if($res) {
        if(mysqli_num_rows($res) > 0) {
            // doctor exists, fetch associated icon
            $img = mysqli_fetch_assoc($res);

            // Attempt to delete associated icon
            if(deleteImage($img['image'], DOCTOR_FOLDER)){
                // Icon deleted, now delete doctor
                $q = "DELETE FROM `doctor` WHERE `id` = ?";
                $res = delete($q, [$frm_data['rem_doctor']], 'i');

                // Check if deletion was successful
                if($res) {
                     echo $res;
                } else {
                    echo "Failed to delete doctor";
                }
            } else {
                echo "Failed to delete image";
            }
        } else {
            echo "doctor not found";
        }
    } else {
        echo "Error executing database query: " . mysqli_error($connection); // Change $connection to your database connection variable
    }
}
?>
