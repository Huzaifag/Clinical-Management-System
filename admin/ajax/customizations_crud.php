<?php
require("../partials/essentials.php");
require("../partials/db_config.php");
adminLogin();
if(isset($_POST['add_image'])){


    // Check if 'picture' is set in $_FILES and it's not empty
    if(isset($_FILES['picture']) && $_FILES['picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img_r = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);
        
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
                $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
                $values = [$img_r];
                $res = insert($q, $values, 's');
                echo $res;
            }
        }
    } else {
        echo "No image uploaded or invalid file.";
    }
}

if(isset($_POST['get_carousal'])){
    // $q = "SELECT * FROM `team_details`";
    // $res = mysqli_query($con, $q);
    $res = selectAll('carousel');
    while($row = mysqli_fetch_assoc($res)){
        $path = CAROUSEL_IMAGE_PATH;
        echo <<<data
            <div class="col-md-2 mb-3">
                <div class="card bg-dark text-white text-end">
                    <img src="{$path}{$row['image']}" class="card-img" alt="team">
                    <div class="card-img-overlay">
                        <button type="button" onclick="rem_image({$row['sr_no']})" class="btn btn-outline-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
data;
    }
}

if(isset($_POST['rem_image'])){
    $frm_data = filteration($_POST);
    $values = array($frm_data['rem_image']); // Changed square brackets to array function
    $pre_q = "SELECT * FROM `carousel` WHERE `sr_no` = ?";
    $res = select($pre_q, $values, 'i');

    $img = mysqli_fetch_assoc($res);
    if(deleteImage($img['image'], CAROUSEL_FOLDER)){
        $q = "DELETE FROM `carousel` WHERE `sr_no` = ?";
        $res = delete($q, $values, 'i');
        echo $res;
    }
    else{
        echo 0;
    }
}


if(isset($_POST['add_facility'])){
    $frm_data = filteration($_POST);

    // Check if 'picture' is set in $_FILES and it's not empty
    if(isset($_FILES['icon']) && $_FILES['icon']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img_r = uploadSVGImage($_FILES['icon'], FEATURES_FOLDER);
        
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
                $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
                $values = [ $img_r,$frm_data['name'],$frm_data['desc']];
                $res = insert($q, $values, 'sss');
                echo $res;
            }
        }
    } else {
        echo "No image uploaded or invalid file.";
    }
}

if(isset($_POST['get_facility'])){
    // $q = "SELECT * FROM `team_details`";
    // $res = mysqli_query($con, $q);
    $res = selectAll('facilities');
    $i = 1;
    $path = FEATURES_IMAGE_PATH;
    while($row = mysqli_fetch_assoc($res)){
        echo <<<data
        <tr class="text-center align-middle">  
        <td>$i</td>
        <td><img src="{$path}{$row['icon']}" alt="{$row['name']}" class="img-fluid" style="width:100px"></td>
        <td>{$row['name']}</td>
        <td>{$row['description']}</td>
        <td><button type="button" onclick="rem_facility({$row['id']})" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i> DELETE
            </button></td>
        </tr>
        data;
        $i++;
    }
}

if(isset($_POST['rem_facility'])){
    // Sanitize input
    $frm_data = filteration($_POST); // Assuming filteration function exists

    // Check if facility exists
    $pre_q = "SELECT * FROM `facilities` WHERE `id` = ?";
    $res = select($pre_q, [$frm_data['rem_facility']], 'i');

    if($res) {
        if(mysqli_num_rows($res) > 0) {
            // Facility exists, fetch associated icon
            $img = mysqli_fetch_assoc($res);

            // Attempt to delete associated icon
            if(deleteImage($img['icon'], FEATURES_FOLDER)){
                // Icon deleted, now delete facility
                $q = "DELETE FROM `facilities` WHERE `id` = ?";
                $res = delete($q, [$frm_data['rem_facility']], 'i');

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
