
  <div class="container-fluid bg-info text-light p-3 d-flex justify-content-between align-items-center sticky-top">
    <h3 class="mb-0 h-font"><i class="bi bi-heart-pulse-fill text-danger me-2"></i>My Clinic</h3> <h2>CLINIC MANAGEMENT SYSTEM</h2>
    <div class="dropdown d-flex align-items-center">
      <button class="btn btn-primary btn-lg shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img width="30px" src="pic/doctor(2).png" alt="">
      <?php if(isset($_SESSION['doctorname'])){echo 'Dr '. $_SESSION['doctorname'];}else{echo "Login";}
      ?>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
        <li><a class="dropdown-item" href="#">Change Password</a></li>
        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
      </ul>
    </div>

  </div>

  <!-- dashboard menu  -->
  <div class="col-lg-2 bg-info border-top border-3 border-secondary" id="dashboard-menu">
  <nav class="navbar navbar-expand-lg navbar-dark justify-content-between" id="nav-bar">
    <div class="container-fluid flex-lg-column align-items-stretch">
      <h4 class="mt-2 text-light">ADMIN PANEL</h4> 
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropDown" aria-controls="adminDropDown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropDown">
        <ul class="nav nav-pills flex-column">      
          <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="appointments.php">📅 Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="patients.php">👨‍🤝‍👨🏾 Manage Patients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="reports.php">🏥 Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="test.php">🩺 Test Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="userqueries.php">❓ User Queries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="profile.php">👨‍⚕️ Profile</a>
          </li>          
          <li class="nav-item">
            <a class="nav-link text-white" href="bill_list.php">💳 Billing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="blogs.php">✍ Blogs</a>
          </li>
        </ul>
    </div>
      </div>
  </nav>
  </div>