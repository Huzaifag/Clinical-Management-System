<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS CLINIC - HOME</title>
    <?php require('partials/links.php'); ?>
    <style>
        
        .availability-form {
            position: relative;
            margin-top: -120px;
            z-index: 2;
        }
        .features {
            position: relative;
            margin-top: -80px;
            z-index: 2;
        }
        

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
            .features {
                margin-top: 25px;
                padding: 0 35px;
        }
        }
    </style>
</head>
<body class="bg-light">
    <?php require('partials/header.php'); ?>

    <!-- Carousel Start -->
<div class="container-fluid px-lg-4 mt-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="card bg-dark text-white">
        <img src="images/carousel/1.webp" class="card-image carousel-img" alt="">
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column text-dark w-50">
                <h1 class="card-title mt-5 h-font fw-bold fs-1">We Care About your Health</h1>
                <p class="card-text">Welcome to Wellness Clinic, where we prioritize your well-being above all else. Our clinic offers a comprehensive range of holistic health services designed to nurture your body, mind, and spirit. From personalized treatment plans to expert guidance, we're dedicated to supporting you on your journey to optimal health and vitality.</p>
                
            </div>
            </div>
      </div>
      <div class="swiper-slide">
        <div class="card bg-dark text-white">
        <img src="images/carousel/2.png" class="card-image carousel-img" alt="">
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column text-dark w-50">
                <h1 class="card-title mt-5 h-font fw-bold fs-1">We Care About your Health</h1>
                <p class="card-text">Welcome to Wellness Clinic, where we prioritize your well-being above all else. Our clinic offers a comprehensive range of holistic health services designed to nurture your body, mind, and spirit. From personalized treatment plans to expert guidance, we're dedicated to supporting you on your journey to optimal health and vitality.</p>
                
            </div>
            </div>
      </div>
      <div class="swiper-slide">
        <div class="card bg-dark text-white">
            <img src="images/carousel/3.jpg" class="card-image carousel-img" alt="">
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column text-dark  w-50">
                <h1 class="card-title mt-5 h-font fw-bold fs-1">We Care About your Health</h1>
                <p class="card-text">Welcome to our Clinic, where we prioritize your well-being above all else. Our clinic offers a comprehensive range of holistic health services designed to nurture your body, mind, and spirit. From personalized treatment plans to expert guidance, we're dedicated to supporting you on your journey to optimal health and vitality. </p>
                
            </div>
            </div>
      </div>
      <div class="swiper-slide">
        <div class="card bg-dark text-white">
            <img src="images/carousel/4.jpg" class="card-image carousel-img" alt="">
            <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column text-dark w-50">
                <h1 class="card-title mt-5 fw-bold fs-1 h-font">We Care About your Health</h1>
                <p class="card-text">Welcome to Wellness Clinic, where we prioritize your well-being above all else. Our clinic offers a comprehensive range of holistic health services designed to nurture your body, mind, and spirit. From personalized treatment plans to expert guidance, we're dedicated to supporting you on your journey to optimal health and vitality.</p>
                
            </div>
            </div>
      </div>
      
    <!-- </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div> -->
</div>
<!-- Carousel End -->

<!-- appointment Section  Starts-->
<div class="container availability-form" id="appointment">
  <div class="row justify-content-around">
    <div class="col-lg-8 bg-white shadow-sm p-4 rounded">
      <h5 class="mb-4">Book Appointment or Call: <span class="text-info">03046902667</span></h5>
      <form>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Select Doctor:</label>
              <select class="form-select shadow-none">
                <option selected>Select Doctor</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Select Date:</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <button class="btn btn-primary">Book Appointment</button>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Phone Number:</label>
              <input type="number" class="form-control shadow-none" placeholder="Phone Number">
            </div>
            <div class="mb-3">
              <label class="form-label">Time:</label>
              <input type="time" class="form-control shadow-none">
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-4 text-primary-green bg-light-blue shadow-sm p-4 rounded">
        <h5 class="mb-4">Openning Hours</h5>
        <div class="d-flex justify-content-between border-bottom border-2 border-dark text-dark mb-3">
            <p>Monday - Thursday<p>
            <p>9:00 AM - 5:00 PM<p>
        </div>
        <div class="d-flex justify-content-between border-bottom border-2 border-dark text-dark mb-3">
            <p>Friday - Satureday<p>
            <p>10:00 AM - 4:00 PM<p>
        </div>
        <div class="d-flex justify-content-between border-bottom border-2 border-dark text-dark mb-3">
            <p>Sunday<p>
            <p>Emergency Only<p>
        </div>
        <div class="d-flex justify-content-between border-bottom border-2 border-dark text-dark">
            <p>Personal<p>
            <p>7:00 PM - 9:00 PM<p>
        </div>
    </div>
  </div>
</div>
<!-- appointment Section  End-->

<!-- Experties Start -->

<div class="container text-primary mt-5">
    <div class="row">
      <!-- about 1 -->
      <div class="col-lg-3 col-md-3 mb-4 px-4">
        <div class="text-center bg-white rounded shadow border-top border-primary border-4 p-4 pop">
          <img src="images/about/doctor.svg" width="70px">
          <h5 class="my-3">10+</h5>
          <h6> Year Experience</h6>
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

  <!-- Experties End  -->

  <!-- Features Start -->
  <h2 class="text-center h-font mt-5 mb-4 pt-4 fw-bold text-primary">Services</h2>
<div class="container-fluid mt-5 bg-primary p-5 div-cont" >
  <div class="row text-white justify-content-around">
    <div class="col-md-5 fw-bold ">
        <h2>Our Best Services For Your Solutions</h2>
    </div>
    <div class="col-md-4">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, nobis facilis error maxime incidunt in recusandae. Velit, necessitatibus et. Accusantium, 
    </div>
  </div>
</div>

<div class="container mb-4 features">
    <div class="row justify-content-evenly">
        <div class=" col-md-3 text-center py-4 my-3 bg-white rounded shadow">
        <img src="images/features/nurse.svg" width="100px" class="mb-3" alt="">
        <h4>General Practioners</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, ab!Lorem ipsum dolor sit amet consectetur</p>
        </div>
        <div class=" col-md-3 text-center py-4 my-3 bg-white rounded shadow">
        <img src="images/features/pragnency.svg" width="100px" class="mb-3" alt="">
        <h4>Pregnancy Support</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, ab!Lorem ipsum dolor sit amet consectetur</p>
        </div>
        <div class="col-md-3 text-center py-4 my-3 bg-white rounded shadow">
        <img src="images/features/pharmacy.svg" width="100px" class="mb-3" alt="">
        <h4>Pharmaceutical Care</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, ab!Lorem ipsum dolor sit amet consectetur</p>
        </div>
        
    </div>
</div>

<!-- Features End -->

  <!-- Testimonial Starts  -->
<h2 class="text-center h-font mt-5 mb-4 pt-4 fw-bold text-primary">TESTIMONIALS</h2>
<div class="container mt-5">
    <!-- Swiper Testimonials -->
    <div class="swiper-container swipper-testimonial">
        <div class="swiper-wrapper">
            <!-- Testimonial 1 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-2">
                    <img src="images/testimonial/user.jpg" width="30px" style="border-radius: 50%;">
                    <h6 class="m-0 ms-1">Random user1</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore quos? Incidunt aut numquam explicabo. Voluptatum?</p>
                <div class="ratings">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-2">
                    <img src="images/testimonial/user.jpg" width="30px" style="border-radius: 50%;">
                    <h6 class="m-0 ms-1">Random user2</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore quos? Incidunt aut numquam explicabo. Voluptatum?</p>
                <div class="ratings">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-2">
                    <img src="images/testimonial/user.jpg" width="30px" style="border-radius: 50%;">
                    <h6 class="m-0 ms-1">Random user3</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore quos? Incidunt aut numquam explicabo. Voluptatum?</p>
                <div class="ratings">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="col-lg-12 text-center">
        <a href="#" class=" btn btn-sm btn-outline-primary shadow-none fw-bold mt-4">
            Know More >>
        </a>
    </div>
</div>
</div>

  <!-- Testimonial End  -->

  <!-- Blog Section Starts  -->
  <h2 class="text-center h-font mt-5 mb-4 pt-4 fw-bold text-primary">BLOGS</h2>
  <div class="container">
    <div class="row">
      <!-- CARD 1 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/blogs/Stress.jpg"  class="card-img-top blog-pic" alt="room-pic">
          <div class="card-body">
            <h5 >Heart-Healthy Habits: Small Changes, Big Impact</h5>
           <span class="badge rounded-pill bg-light text-dark">JAN 24, 2024</span>
            <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From dietary tips to exercise routines...</p> 
            <div class="d-flex justify-content-evenly">              
              <a href="#" class="btn btn-sm btn-outline-success shadow-none">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- CARD 2 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/blogs/heart.jpeg" class="card-img-top blog-pic" alt="room-pic">
          <div class="card-body">
            <h5 >The Link Between Emotions and Heart Health</h5>
           <span class="badge rounded-pill bg-light text-dark">JAN 26, 2024</span>
            <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From dietary tips to exercise routines...</p> 
            <div class="d-flex justify-content-evenly">
            <a href="#" class="btn btn-sm btn-outline-success shadow-none">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- CARD 3 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/blogs/dental.jpg" class="card-img-top blog-pic" alt="room-pic">
          <div class="card-body">
            <h5 >The Journey to a Stress-Free Dental Experience</h5>
           <span class="badge rounded-pill bg-light text-dark">JAN 24, 2024</span> 
            <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From dietary tips to exercise routines...</p> 
            <div class="d-flex justify-content-evenly">
            <a href="#" class="btn btn-sm btn-outline-success shadow-none">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 text-center">
        <a href="#" class=" btn btn-sm btn-outline-primary shadow-none fw-bold mt-4">
          More Blogs >>
        </a>
      </div>
      </div>
    </div>
  </div>
  <!-- Blog Section Ends  -->

  <!-- Questioners  -->
  <h2 class="text-center h-font mt-5 mb-4 pt-4 fw-bold text-primary">Questioners</h2>
<div class = "container">
  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      What services does your clinic offer?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      How can I schedule an appointment at your clinic?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      Do you offer telemedicine or virtual consultations?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      What sets your clinic apart from others in the area?
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>
  </div>

    <!-- Reach Us Start  -->
  <h2 class="text-center h-font mt-5 mb-4 pt-4 fw-bold text-primary">Reach Us</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe height="320px" class="w-100 rounded mb-4"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13796.159493267167!2d72.20588198764041!3d30.178854947145116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393cba39c923e429%3A0x243aca6cec64ed0b!2z2KfaiNinINmI2KzavtuM2KfZiNin2YTbgSwgVmVoYXJpLCBQdW5qYWIsIFBha2lzdGFu!5e0!3m2!1sen!2s!4v1713836385670!5m2!1sen!2s"  height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 mb-4">
          <h5>Call us</h5>
          <a class="d-inline-block mb-4 text-decoration-none text-dark" href="tel: +923046902667">
            <i class="bi bi-telephone-fill me-1"></i>03046902667
          </a><br>
          <a class="d-inline-block mb-4 text-decoration-none text-dark" href="tel: +923046902667">
            <i class="bi bi-telephone-fill me-1"></i>03046902667
          </a>
        </div>
        <div class="bg-white p-4 mb-4">
          <h5>Follow us</h5>
          <a class="d-inline-block mb-3" href="#">
            <span class="badge bg-light text-dark p-2 fs-6">
              <i class="bi bi-twitter-x me-1"></i>Twitter
            </span>
          </a><br>
          <a class="d-inline-block mb-3" href="#">
            <span class="badge bg-light text-dark p-2 fs-6">
              <i class="bi bi-facebook me-1"></i>Facebook
            </span>
          </a><br>
          <a class="d-inline-block " href="#">
            <span class="badge bg-light text-dark p-2 fs-6">
              <i class="bi bi-instagram me-1"></i>Instagram
            </span>
          </a><br>
        </div>
      </div>
    </div>
  </div>

  <!-- Reach Us end  -->

    <?php require('partials/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

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