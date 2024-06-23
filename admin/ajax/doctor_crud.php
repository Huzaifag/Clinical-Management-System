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
    // Assuming selectAll function retrieves data correctly
    $res = selectAll('doctor');
    $i = 1;
    $path = DOCTOR_IMAGE_PATH;
    $status = '';
    while($row = mysqli_fetch_assoc($res)){
        // Determine the status button HTML based on 'status' field
        if($row['status'] == 0){
            $status = "<button type='button' onclick=\"set_doctor({$row['id']},1)\" class='btn btn-danger btn-sm shadow-none'>
            Active
            </button>";
        }
        else{
            $status = "<button type='button' onclick=\"set_doctor({$row['id']},0)\" class='btn btn-dark btn-sm shadow-none'>
            Retired
            </button>";
        }
    
        // Output each row of doctor information
        echo <<<data
        <tr class="text-center align-middle">  
        <td>{$i}</td>
        <td>{$row['name']}</td>
        <td>{$row['Specialization']}</td>
        <td>+{$row['pn']}</td>
        <td>{$row['date_of_join']}</td>
        <td>{$row['fees']}</td>
        <td>{$status}</td>
        <td><a type='button' href="doctors_profile.php?doc_id={$row['id']}" class='btn btn-success btn-sm shadow-none'>
            Profile
            </a>
        </td>
        </tr>
        data;
        $i++;
    }
    
}



if(isset($_POST['set_doctor'])){
    $id = $_POST['set_doctor'];
    $status = $_POST['value'];
    $query = "UPDATE `doctor` SET `status`= ?  WHERE `id` = ?";
    $values = [$status, $id];
    $res = update($query, $values, 'ii');
    if($res){
        echo $res;
    } else {
        echo "Failed to update";
    }
        
}

?>
