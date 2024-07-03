
  <div class="container-fluid bg-info text-light p-3 d-flex justify-content-between align-items-center sticky-top">
    <h3 class="mb-0 h-font"><i class="bi bi-heart-pulse-fill text-danger me-2"></i>My Clinic</h3> <h2>CLINIC MANAGEMENT SYSTEM</h2>
    <div class="dropdown">
      <button class="btn btn-danger btn-lg shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-workspace"></i>
      <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{echo "Login";}
      ?>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="../index.php">Home</a></li>
        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
      </ul>
    </div>

  </div>

  <!-- dashboard menu  -->
  <div class="col-lg-2 bg-info border-top border-3 border-secondary" id="dashboard-menu">
  <nav class="navbar navbar-expand-lg navbar-dark justify-content-between" id="nav-bar">
    <div class="container-fluid flex-lg-column align-items-stretch">
      <h4 class="mt-2 text-light">USER PANEL</h4> 
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropDown" aria-controls="adminDropDown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropDown">
        <ul class="nav nav-pills flex-column">      
          <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="appointments.php"><i class='bx bx-calendar-plus fs-5 me-1'></i></i>My Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="patients.php"><i class="bi bi-person me-1"></i>Manage Patients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="staff.php"><i class="bi bi-people me-1"></i>Manage Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="userqueries.php"><i class="bi bi-question-circle me-1"></i>User Queries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="bill_list.php"><i class="bi bi-receipt me-1"></i>My Bills</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="inventory.php"><i class="bi bi-box me-1"></i>Inventory</a>
          </li>          
          <li class="nav-item">
            <a class="nav-link text-white" href="customization.php"><i class="bi bi-puzzle me-1"></i>Customization</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="settings.php"><i class="bi bi-gear me-1"></i>Setting</a>
          </li>
        </ul>
    </div>
      </div>
  </nav>
  </div>