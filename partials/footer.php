<?php
// require('admin/partials/db_config.php');
// require('admin/partials/essentials.php');
// Query to select data
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
$values = [1];
$contact_r = select($contact_q, $values, 'i');
if ($contact_r) {
    $contact_data = mysqli_fetch_array($contact_r);
    $fb = $contact_data['fb'];
    $insta = $contact_data['insta'];
    $tw = $contact_data['tw'];
}
$generals_q = "SELECT * FROM `generals` WHERE `id` = ?";
$values = [1];
$generals_r = select($generals_q, $values, 'i');
if ($generals_r) {
    $generals_data = mysqli_fetch_array($generals_r);
    $site_title = $generals_data['site_title'];
    $about_us = $generals_data['about_us'];
    $shutdown = false;
    if($generals_data['shutdown'] == 1){
      $shutdown = true;
    }
}
?>

<!-- footer  -->

  <div class="container-fluid bg-white mt-5">
      <div class="row">
        <div class="col-lg-4 p-4">
          <h5 class="h-font fw-bold fs-3 mb-3"><i class="bi bi-heart-pulse-fill text-primary me-2"></i><?php echo $site_title; ?></h5>
          <p><?php echo $about_us; ?></p>
        </div>
        <div class="col-lg-4 p-4">
          <h5 class="mb-3">Links</h5>
          <a href="#" class="mb-2 text-dark d-inline-block text-decoration-none">Blogs</a><br>
          <a href="#" class="mb-2 text-dark d-inline-block text-decoration-none">Rooms</a><br>
          <a href="#" class="mb-2 text-dark d-inline-block text-decoration-none">Facilities</a><br>
          <a href="#" class="mb-2 text-dark d-inline-block text-decoration-none">Contact us</a><br>
          <a href="#" class="mb-2 text-dark d-inline-block text-decoration-none">About</a>
        </div>
        <div class="col-lg-4 p-4">
          <h5 class="mb-3">Follow us</h5>
          <a class="mb-2 text-dark d-inline-block text-decoration-none" href="<?php echo $tw; ?>">         
              <i class="bi bi-twitter-x me-1"></i>Twitter
          </a><br>
          <a class="mb-2 text-dark d-inline-block text-decoration-none" href="<?php echo $fb; ?>">         
            <i class="bi bi-facebook me-1"></i>Facebook
          </a><br>
          <a class="mb-2 text-dark d-inline-block text-decoration-none" href="<?php echo $insta; ?>">         
            <i class="bi bi-instagram me-1"></i>Instagram
          </a>
        </div>
      </div>
    </div>
  <h6 class="text-center text-white bg-primary m-0 p-3">Design and Develop by Huzaifa Gulzar</h6>
    <!-- bootstrap Javascript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    function showAlert(type, msg, position = 'body') {
  // Remove any existing alerts
  let existingAlert = document.querySelector('.custem-alert');
  if (existingAlert) {
    existingAlert.remove();
  }

  // Create and append the new alert
  let bsClass = (type === 'success') ? 'alert-success' : 'alert-danger';
  let element = document.createElement('div');
  let settings = document.getElementById('alert_div');
  element.innerHTML = `
    <div class="alert ${bsClass} alert-dismissible fade show" role="alert">
      <strong>${msg}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;

  if (position === 'body') {
    // appending the element to the body
    settings.insertAdjacentElement('afterbegin', element);
    element.classList.add('custem-alert')
  } else {
    document.getElementById(position).appendChild(element);
  }
}
</script>