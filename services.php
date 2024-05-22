<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HG Hotels - SERVICES</title>
  <?php require('partials/links.php');?> 
 <style>
  .pop:hover{
    border-top-color:var(--button_color_hover) !important;
    transform: scale(1.03);
    transition: all 0.3s;
    background-color: blue;
  }
 </style>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
  <div class="my-5 px-4">
    <h2 class="text-center text-primary h-font fw-bold">OUR SERVICES</h2>
    <div class="h-line bg-primary"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor sit amet consectetur adipisicing elit.
       Animi fugit iste ipsum recusandae <br> consequatur ad sit 
       provident. Reprehenderit, consequatur numquam.
      </p>
      <div class="container">
        <div class="row">
          <!-- Facility 1 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
              <img src="images/features/nurse.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">General Practioners</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>
          <!-- Facility 2 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
              <img src="images/features/pragnency.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">Pregnancy Support</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>

          <!-- Facility 3 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
              <img src="images/features/pharmacy.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">Pharmaceutical Care</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>
          <!-- Facility 4 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
              <img src="images/features/emergency.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">Emergency Medicine</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>
          <!-- Facility 5 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
              <img src="images/features/therapy.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">Natural Therapies</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>
          <!-- Facility 6 -->
          <div class="col-lg-4 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded border-top p-4 border-4 border-primary pop">
              <div class="d-flex align-items-center mb-2">
               <img src="images/features/elder.svg" width="40px" alt="">
                <h5 class="ms-2 m-0">Elderly Care</h5>
              </div>
              <p>
                Lorem ipsum, dolor sit amet consectetur
                 adipisicing elit. Reprehenderit, dolore
                 mque! Eligendi, ullam repellendus? Aliq
                 uid, ullam nemo.
                </p>
            </div>
          </div>

        </div>
      </div>
  </div>
  <?php require('partials/footer.php')?>

</body>
</html>