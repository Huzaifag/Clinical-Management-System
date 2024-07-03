<?php
require('admin/partials/db_config.php');
require('admin/partials/essentials.php');
// Query to select data
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
$values = [1];
$contact_r = select($contact_q, $values, 'i');
if ($contact_r) {
    $contact_data = mysqli_fetch_array($contact_r);
}
$generals_q = "SELECT * FROM `generals` WHERE `id` = ?";
$values = [1];
$generals_r = select($generals_q, $values, 'i');
if ($generals_r) {
    $generals_data = mysqli_fetch_array($generals_r);
    $site_title = $generals_data['site_title'];
    $shutdown = false;
    if($generals_data['shutdown'] == 1){
      $shutdown = true;
    }
}
?>
<?php
// Start the session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $userEmail = $_POST['user_email'];
        $password = $_POST['user_password'];
        $sql = "SELECT * FROM `patient` WHERE `email` = '$userEmail'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);
        if ($row == 1) {
            while ($hash = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $hash['password'])) {
                    $logIn = true;
                    $_SESSION['user_loggedin'] = true;
                    $_SESSION['username'] = $hash['name'];
                    $_SESSION['userId'] = $hash['id'];
                    redirect('index.php');
                    exit; // Added to stop further execution after redirection
                }
                else{
                  alert('Failed', 'Wrong Credentials...');
                }
            }
        }
    }
}
?>

<!-- Nav Start  -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">
    <i class="bi bi-heart-pulse-fill text-primary me-2"></i><?php echo $site_title; ?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="blogs.php">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
      
      </ul>
      <?php
      if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] = true) { // Check if user is not logged in or not set
        echo '<div class="dropdown">
        <button class="btn btn-outline-primary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle me-2 fs-5"></i>'.$_SESSION['username'].' <!-- Move the username inside the icon tag -->
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="patient/dashboard.php">Dashboard</a></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
        </ul>
      </div>';
      } else {
        echo '<form class="d-flex">
        <button type="button" class="btn btn-outline-primary me-lg-3 me-2 shadow-none" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-outline-primary shadow-none " data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>  
      </form>';
      }
      ?>
    </div>
  </div>
</nav>
<!--   
                                                 NAVBAR END
                                                                                             -->

<!--   
                                                 LoginModal Start
                                                                                             -->


  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="login_form" method = "POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center text-primary">
            <i class="bi bi-person-circle me-2 fs-3"></i>User Login</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label  class="form-label">Email address</label>
              <input type="email" name ="user_email" class="form-control shadow-none">
              <div class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-4">
              <label  class="form-label">Password</label>
              <input type="password" name ="user_password" class="form-control shadow-none">  
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
              <button type="submit" name="login" class="btn btn-primary shadow-none">LOGIN</button>
              <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forget Password?</a>
            </div>
          </div>
          
        </div>
      </form>
    </div>
  </div>
  <!--   
                                                 LoginModal END
                                                                                             -->

<!--   
                                                 RegisterModal Start
                                                                                             -->


  <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="register_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center text-primary">
              <i class="bi bi-person-lines-fill me-2 fs-3"></i>User Registeration
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
              Note: Your deatils must match with your ID(National Identity Card (CNIC),Passport etc...) that will be required during check-in.
            </span>
            <div class="container-fluid">
              <div class="row mb-3">
                <div class="col-md-6 ps-0">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control shadow-none">
                </div>
                <div class="col-md-6 p-0">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control shadow-none">
                </div>
              </div>
              <div class="row mb-3"> 
                <div class="col-md-6 ps-0">
                  <label class="form-label">Phone Number</label>
                  <input type="number" name="pn" class="form-control shadow-none">
                </div>
                <div class="col-md-6 p-0">
                  <label class="form-label">Picture</label>
                  <input type="file" name="image" class="form-control shadow-none" accept=".jpg, .png, .webp, .jpeg" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-12 p-0">
                  <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                 <textarea class="form-control" name="address" rows="1"></textarea>
                </div>
              </div>
              <div class="row mb-3"> 
                <div class="col-md-6 ps-0">
                  <label class="form-label">Gender</label>
                  <select class="form-select" name="gender" aria-label="Default select example">
                    <option selected>select your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="col-md-6 p-0">
                  <label class="form-label">Date of birth</label>
                  <input type="date" name="dob" class="form-control shadow-none">
                </div>
              </div>
              <div class="row mb-3"> 
                <div class="col-md-6 ps-0">
                  <label class="form-label">Password</label>
                  <input type="password" name="pass" class="form-control shadow-none">
                </div>
                <div class="col-md-6 p-0">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name ="cpass" class="form-control shadow-none">
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary shadow-none">REGISTER</button>
            </div>
            </div>
          
          </div>
          
        </div>
      </form>
    </div>
  </div>

  <div id ="alert_div"></div>

  <!-- form end  -->

<script>
    register_form = document.getElementById('register_form');
    register_form.addEventListener('submit' ,function(e){
    e.preventDefault();
   add_patient();
 })

 function add_patient() {
    let data = new FormData();
    data.append('image', register_form['image'].files[0]);

    let patient_data = ['name', 'email', 'pn', 'address', 'gender', 'dob', 'pass', 'cpass'];

    for (let i = 0; i < patient_data.length; i++) {
        data.append(patient_data[i], register_form[patient_data[i]].value);
    }

    data.append('add_patient', '');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "patient_regs.php", true);
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'inv_img') {
                showAlert('error', 'Invalid image type. Only JPG, JPEG, PNG allowed');
            } else if (this.responseText == 'inv_size') {
                showAlert('error', 'Invalid image Size. Size Should be less than 2MB');
            } else if (this.responseText == 'upload_failed') {
                showAlert('error', 'Image failed to upload. Server Down');
            } else if (this.responseText == 2) {
                showAlert('error', 'Password and confirm password are not the same');
            }
            else if (this.responseText == 2) {
                showAlert('error', 'User Already exist');
            } else {
                showAlert('success', ' Account has been created Successfully');
                
                document.getElementById("register_form").reset(); // Reset the form
            }
            // Assuming Bootstrap is correctly included and initialized
            $('#registerModal').modal('hide');
            
        }
    };
    xhr.send(data);
}
</script>


  

