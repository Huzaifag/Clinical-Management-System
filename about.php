<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HG Hotels - ABOUT</title>
  <?php require('partials/links.php');?> 
 <style>
  .pop:hover{
    border-top-color:var(--button_color_hover) !important;
    transform: scale(1.03);
    transition: all 0.3s;
  }
 </style>
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
  <div class="my-5 px-4">
    <h2 class="text-center h-font fw-bold text-primary">ABOUT US</h2>
    <div class="h-line bg-primary"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor sit amet consectetur adipisicing elit.
       Animi fugit iste ipsum recusandae <br> consequatur ad sit 
       provident. Reprehenderit, consequatur numquam.
      </p>
  </div>
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-5 order-lg-1 order-md-1 order-2">
        <h5 class="mb-3">Lorem ipsum dolor sit</h5>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Deserunt ab corrupti temporibus dignissimos consectetur, 
          in quo.
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Deserunt ab corrupti temporibus dignissimos consectetur, 
          in quo.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-5 order-lg-2 order-md-2 order-1">
        <img src="images/about/doctor.png" alt="about" class="w-100">
      </div>
    </div>
  </div>

<!-- Experties Start -->
<div class="container text-primary mt-5">
    <div class="row">
        <!-- about 1 -->
        <div class="col-lg-3 col-md-3 mb-4 px-4">
            <div class="text-center bg-white rounded shadow border-top border-primary border-4 p-4 pop">
                <img src="images/about/doctor.svg" width="70px">
                <h5 class="my-3">10+</h5>
                <h6>Year Experience</h6>
            </div>
        </div>
        <!-- about 2 -->
        <div class="col-lg-3 col-md-3 mb-4 px-4">
            <div class="text-center bg-white rounded shadow border-top border-primary border-4 p-4 pop">
                <img src="images/about/staff.webp" width="100px">
                <h5 class="my-3">20+</h5>
                <h6>Qualified Staff</h6>
            </div>
        </div>
        <!-- about 3 -->
        <div class="col-lg-3 col-md-3 mb-4 px-4">
            <div class="text-center bg-white rounded shadow border-top border-primary border-4 p-4 pop">
                <img src="images/about/patient.svg" width="90px">
                <h5 class="my-3">200+</h5>
                <h6>Patients</h6>
            </div>
        </div>
        <!-- about 4 -->
        <div class="col-lg-3 col-md-3 mb-4 px-4">
            <div class="text-center bg-white rounded shadow border-top border-primary border-4 p-4 pop">
                <img src="images/about/review.png" width="70px">
                <h5 class="my-3">150+</h5>
                <h6>Reviews</h6>
            </div>
        </div>
    </div>
  </div>
  </div>
<!-- Experties End -->

<!-- MANAGEMENT TEAM Start -->
<h3 class="my-5 fw-bold h-font text-center text-primary">MANAGEMENT TEAM</h3>
<div class="container mt-5">
    <!-- Swiper Testimonials -->
    <div class="swiper-container swipper-testimonial">
        <div class="swiper-wrapper">
            <!-- Testimonial 1 -->
            <div class="swiper-slide bg-white p-4">
                <div class="team-card" ="400px">
                    <div class="row">
                        <div class="col-lg-6">
                        <img src="images/about/mujahid.png" width="100%" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-lg-6">
                            <h5>Dr Mujahid</h5>
                            <p class="text-success">Doctor</p>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui perspiciatis nemo harum tenetur repellendus, pariatur nisi similique repellat nihil corporis.</p>
                            <span class="d-flex justify-content-evenly">
                              <a class="text-dark " href="#"><i class="bi bi-facebook"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-twitter"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-instagram"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="swiper-slide bg-white p-4">
                <div class="row">
                    <div class="col-lg-6">
                    <img src="images/about/nurse.png" width="100%" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-lg-6">
                        <h5>Neelam Shah</h5>
                        <p class="text-success">Nurse</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui perspiciatis nemo harum tenetur repellendus, pariatur nisi similique repellat nihil corporis.</p>
                        <span class="d-flex justify-content-evenly">
                              <a class="text-dark " href="#"><i class="bi bi-facebook"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-twitter"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-instagram"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="swiper-slide bg-white p-4">
                <div class="row">
                    <div class="col-lg-6">
                    <img src="images/about/pharmacist.png" width="100%" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-lg-6">
                        <h5>Amir Ali</h5>
                        <p class="text-success">Pharmacist</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui perspiciatis nemo harum tenetur repellendus, pariatur nisi similique repellat nihil corporis.</p>
                        <span class="d-flex justify-content-evenly">
                              <a class="text-dark " href="#"><i class="bi bi-facebook"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-twitter"></i></a>
                              <a class="text-dark " href="#"><i class="bi bi-instagram"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
    <div class="col-lg-12 text-center">
        <a href="#" class=" btn btn-sm btn-outline-primary shadow-none fw-bold mt-4">
            Know More >>
        </a>
    </div>
</div>
</div>

  <!-- Testimonial End  -->

  <!-- Testimonial End  -->

  <?php require('partials/footer.php')?>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <!-- Initialize Swiper -->
 <script>

var swiper = new Swiper(".swipper-testimonial", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: 3,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });

</script>
</body>
</html>