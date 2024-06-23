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
      margin-top: -100px;
      z-index: 2;
    }

    * {
      padding: 0;
      margin: 0;
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
  <div class="container-fluid mt-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            $slider_res = selectAll('carousel');
            $path = CAROUSEL_IMAGE_PATH;
            while ($slider_data = mysqli_fetch_assoc($slider_res)) {
                echo '
                <div class="swiper-slide">
                    <div class="card bg-dark text-white border-0">
                        <img src="' . $path . $slider_data['image'] . '" class="card-img carousel-img" alt="">
                        <div class="card-img-overlay border-0 d-flex align-items-center justify-content-center flex-column text-dark w-50">
                            <h1 class="card-title mt-5 h-font fw-bold fs-1">We Care About Your Health</h1>
                            <p class="card-text">Welcome to Wellness Clinic, where we prioritize your well-being above all else. Our clinic offers a comprehensive range of holistic health services designed to nurture your body, mind, and spirit. From personalized treatment plans to expert guidance, we\'re dedicated to supporting you on your journey to optimal health and vitality.</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
  </div>
<!-- Carousel End -->


      <!-- appointment Section  Starts-->
      <div class="container availability-form" id="appointment">
        <div class="row justify-content-around">
          <div class="col-lg-8 bg-white shadow-sm p-4 rounded">
            <h5 class="mb-4">Book Appointment or Call: <span class="text-info">03046902667</span></h5>
            <form method = "POST">
              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" name="doctor">Select Doctor:</label>
                    <select class="form-select shadow-none" name="doctor">
                      <option selected>Select Doctor</option>
                      <?php
                        $res = selectAll('doctor');
                        while($row = mysqli_fetch_assoc($res)){
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                    <div class="mb-3">
                      <label class="form-label">Select Date:</label>
                      <input name="date" type="date" class="form-control shadow-none">
                    </div>
                    <button type="submit" name="book_appointment" class="btn btn-primary">
                      Book Appointment
                    </button>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Phone Number:</label>
                      <input type="number" name="pn" class="form-control shadow-none" placeholder="Phone Number">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Time:</label>
                      <input type="time" name="time" class="form-control shadow-none">
                    </div>
                  </div>
              </div>
            </form>
          </div>

          <?php
            $generals_q = "SELECT * FROM `generals` WHERE `id` = ?";
            $values = [1];
            $generals_r = select($generals_q, $values, 'i');
            if ($generals_r) {
                $generals_data = mysqli_fetch_array($generals_r);
                $site_title = $generals_data['site_title'];
                
                

            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              if(isset($_POST['book_appointment'])){
                if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
                  if($generals_data['shutdown'] == 0){
                    $query = "INSERT INTO `appointments`(`date`, `time`, `doctor_id`, `patient_id`) VALUES (? , ? , ? , ?)";

                    $values = [$_POST['date'],$_POST['time'],$_POST['doctor'],$_SESSION['userId']];
                    $result = insert($query, $values, 'ssii');
                    if($result){
                      alert('success', 'Your Appointments has been Booked');
                    }
                    else{
                      alert('Sorry', 'Something went wrong');
                    }
                  }
                  else{
                    alert('Sorry', 'Appointments are not available');
                  }
                }
                else{
                  alert('Not Booked', 'Please Login to Book Appointment');
                }
              }
            }
            
          ?>

          <?php
            $schedule_r = selectAll('schedule');
          ?>
          <div class="col-lg-4 text-primary-green bg-light-blue shadow-sm p-4 rounded">
            <h5 class="mb-4">Openning Hours</h5>
            <?php
              while($row = mysqli_fetch_assoc($schedule_r)){
                $open = date("h:i A", strtotime($row['open']));
                $close = date("h:i A", strtotime($row['close']));
                if($row['status'] == 1){
                  $timing = 'Emergency only';
                }
                else{
                  $timing = $open.' - '.$close;
                }
                echo '
                <div class="d-flex justify-content-between border-bottom border-2 border-dark text-dark mb-3">
                  <p>'.$row['day'].'<p>
                  <p>'.$timing.'<p>
                </div>';
              }
            ?>
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
      <div class="container mt-5 bg-primary p-5 div-cont">
        <div class="row text-white justify-content-around">
          <div class="col-md-5 fw-bold">
            <h2 class="h-font">Our Best Services For Your Solutions</h2>
          </div>
          <div class="col-md-5">
           Our best services provide tailored solutions, ensuring  personalized care, innovative treatments, and comprehensive  support to meet your unique health needs, enhancing your   well-being and quality of life.
          </div>
        </div>
      </div>

      <div class="container mb-4 features">
        <div class="row justify-content-evenly">
          <?php
            $feature_res = selectAll('facilities');
            $feature_path = FEATURES_IMAGE_PATH;
            while ($feature = mysqli_fetch_assoc($feature_res)) {
                echo '
                <div class="col-md-3 text-center py-4 my-3 bg-white rounded shadow">
                    <img src="' . $feature_path . $feature['icon'] . '" width="100px" class="mb-3" alt="">
                    <h4>'.$feature["name"].'</h4>
                    <p>'.$feature["description"].'</p>
                </div>';
            }
          ?>
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
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore
                quos? Incidunt aut numquam explicabo. Voluptatum?</p>
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
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore
                quos? Incidunt aut numquam explicabo. Voluptatum?</p>
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
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita sit dolores suscipit magni, labore
                quos? Incidunt aut numquam explicabo. Voluptatum?</p>
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
            <img src="images/blogs/Stress.jpg" class="card-img-top blog-pic" alt="room-pic">
            <div class="card-body">
              <h5>Heart-Healthy Habits: Small Changes, Big Impact</h5>
              <span class="badge rounded-pill bg-light text-dark">JAN 24, 2024</span>
              <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From
                dietary tips to exercise routines...</p>
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
              <h5>The Link Between Emotions and Heart Health</h5>
              <span class="badge rounded-pill bg-light text-dark">JAN 26, 2024</span>
              <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From
                dietary tips to exercise routines...</p>
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
              <h5>The Journey to a Stress-Free Dental Experience</h5>
              <span class="badge rounded-pill bg-light text-dark">JAN 24, 2024</span>
              <p>Explore the journey to a healthier heart with our blog series dedicated to heart-healthy habits. From
                dietary tips to exercise routines...</p>
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
  <div class="container">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            What services does your clinic offer?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin
            adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            How can I schedule an appointment at your clinic?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse
            plugin adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Do you offer telemedicine or virtual consultations?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
            adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            What sets your clinic apart from others in the area?
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
            adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
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
        <iframe height="320px" class="w-100 rounded mb-4" 
          src="<?php echo $contact_data['iframe'];?>" height="450"
          loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 mb-4">
          <h5>Call us</h5>
          <a class="d-inline-block mb-4 text-decoration-none text-dark" 
            href="tel: +<?php echo $contact_data['pn1'];?>">
            <i class="bi bi-telephone-fill me-1"></i>+<?php echo $contact_data['pn1'];?>
          </a><br>
          <?php
            if($contact_data['pn2'] != ''){
              echo <<<data
              <a class="d-inline-block mb-4 text-decoration-none text-dark" href="tel:{$contact_data['pn2']}">
                  <i class="bi bi-telephone-fill me-1"></i>+{$contact_data['pn2']}
              </a>
            data;
            }
          ?>
        </div>
        <div class="bg-white p-4 mb-4">
          <h5>Follow us</h5>
          <?php
            if($contact_data['tw'] != ''){
              echo <<<html
              <a class="d-inline-block" href="{$contact_data['tw']}" target = "_blank">
                <span class="badge bg-light text-dark p-2 fs-6">
                  <i class="bi bi-twitter-x me-1"></i>Twitter
                </span>
              </a><br>
            html;
            }
          ?><br>
          <a class="d-inline-block mb-3" href="<?php echo $contact_data['fb'];?>"
             target="_blank">
            <span class="badge bg-light text-dark p-2 fs-6">
              <i class="bi bi-facebook me-1"></i>Facebook
            </span>
          </a><br>
          <a class="d-inline-block " href="<?php echo $contact_data['insta'];?>"
           target="_blank">
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