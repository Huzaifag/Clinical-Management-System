<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HG Hotels - CONTACT</title>
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
    <h2 class="text-center h-font fw-bol text-primary">CONTACT US</h2>
    <div class="h-line bg-primary"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor sit amet consectetur adipisicing elit.
       Animi fugit iste ipsum recusandae <br> consequatur ad sit 
       provident. Reprehenderit, consequatur numquam.
      </p>
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 mb-5 px-4 ">
            <div class="bg-white shadow rounded p-4 ">
            <iframe height="320px" class="w-100 rounded mb-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13796.159493267167!2d72.20588198764041!3d30.178854947145116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393cba39c923e429%3A0x243aca6cec64ed0b!2z2KfaiNinINmI2KzavtuM2KfZiNin2YTbgSwgVmVoYXJpLCBQdW5qYWIsIFBha2lzdGFu!5e0!3m2!1sen!2s!4v1713836385670!5m2!1sen!2s"  height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

              <h5>Address</h5>
              <a href="https://maps.app.goo.gl/5PttkX9zhRbpNbGH6" class="d-inline-block text-decoration-none text-dark mb-2" target ="_blank">
              <i class="bi bi-geo-alt-fill"></i> XYZ, Wijhianwala, Vehari, Punjab
              </a>

              <h5 class = "mt-4">Call us</h5>
                <a class="d-inline-block mb-4 text-decoration-none text-dark" href="tel: +923046902667">
                  <i class="bi bi-telephone-fill me-1"></i>03046902667
                </a><br>
                <a class="d-inline-block text-decoration-none text-dark" href="tel: +923046902667">
                  <i class="bi bi-telephone-fill me-1"></i>03046902667
                </a>

                <h5 class="mt-4">Email us</h5>
                <a href="mailto: huzaifa6715@gmail.com" class="d-inline-block text-decoration-none text-dark">
                <i class="bi bi-envelope-at-fill"></i> huzaifa6715@gmail.com
                </a>

                <h5 class="mt-4">Follow us</h5>
                  <a class="d-inline-block text-dark fs-5" href="#">
                      <i class="bi bi-twitter-x me-2"></i>
                  </a>
                  <a class="d-inline-block text-dark fs-5" href="#">
                      <i class="bi bi-facebook me-2"></i>
                  </a>
                  <a class="d-inline-block text-dark fs-5 " href="#">
                      <i class="bi bi-instagram "></i>
                  </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 px-4 ">
            <div class="bg-white shadow rounded p-4">
              <h5>Send a message</h5>
              <div class="mt-3">
                <label  class="form-label">Name</label>
                <input type="text" class="form-control shadow-none">
              </div>
              <div class="mt-3">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control shadow-none">
              </div>
              <div class="mt-3">
                <label  class="form-label">Subject</label>
                <input type="Text" class="form-control shadow-none">
              </div>
              <div class="mt-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                 <textarea class="form-control" rows="5" style="resize: none;"></textarea>
              </div>
              <button type="submit" class="btn text-white custom-bg mt-3 shadow-none">REGISTER</button>
          </div>
        </div>
      </div>
  </div>
  </div>

  <?php require('partials/footer.php')?>

</body>
</html>