<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();


if(isset($_POST['add_staff'])){
    $frm_data = filteration($_POST);

    // Check if 'picture' is set in $_FILES and it's not empty
    if(isset($_FILES['staff_picture']) && $_FILES['staff_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img_r = uploadImage($_FILES['staff_picture'], ABOUT_FOLDER);
        
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
                $q = "INSERT INTO `staff`(`name`, `image`, `role`, `pn`, `description`, `fb`, `insta`, `tw`, `address`) VALUES (?,?,?,?,?,?,?,?,?)";
                $values = [ $frm_data['name'],$img_r,$frm_data['role'],$frm_data['pn'],$frm_data['description'],$frm_data['fb'],$frm_data['insta'],$frm_data['tw'],$frm_data['address']];
                $res = insert($q, $values, 'sssisssss');
                echo $res;
            }
        }
    } else {
        echo "No image uploaded or invalid file.";
    }
}

if(isset($_POST['get_staff'])){
    // $q = "SELECT * FROM `team_details`";
    // $res = mysqli_query($con, $q);
    $res = selectAll('staff');
    $i = 1;
    $path = ABOUT_IMAGE_PATH;
    while($row = mysqli_fetch_assoc($res)){
        echo <<<data
        <tr class="text-center align-middle">  
        <td>$i</td>
        <td>{$row['name']}</td>
        <td>{$row['role']}</td>
        <td>+{$row['pn']}</td>
        <td>{$row['address']}</td>
        <td><button type="button" onclick="rem_staff({$row['id']})" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i> DELETE
            </button>
        </td>
        <td><a type='button' href="staff_profile.php?staff_id={$row['id']}" class='btn btn-success btn-sm shadow-none'>
            Profile
            </a>
        </td>
        </tr>
        data;
        $i++;
    }
}

if(isset($_POST['rem_staff'])){
    // Sanitize input
    $frm_data = filteration($_POST); // Assuming filteration function exists

    // Check if facility exists
    $pre_q = "SELECT * FROM `staff` WHERE `id` = ?";
    $res = select($pre_q, [$frm_data['rem_staff']], 'i');

    if($res) {
        if(mysqli_num_rows($res) > 0) {
            // Facility exists, fetch associated icon
            $img = mysqli_fetch_assoc($res);

            // Attempt to delete associated icon
            if(deleteImage($img['image'], ABOUT_FOLDER)){
                // Icon deleted, now delete facility
                $q = "DELETE FROM `staff` WHERE `id` = ?";
                $res = delete($q, [$frm_data['rem_staff']], 'i');

                // Check if deletion was successful
                if($res) {
                     echo $res;
                } else {
                    echo "Failed to delete facility";
                }
            } else {
                echo "Failed to delete icon";
            }
        } else {
            echo "Facility not found";
        }
    } else {
        echo "Error executing database query: " . mysqli_error($connection); // Change $connection to your database connection variable
    }
}
?>
