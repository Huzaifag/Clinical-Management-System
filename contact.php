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
            <iframe height="320px" class="w-100 rounded mb-4" src="<?php echo $contact_data['iframe']?>"  height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

              <h5>Address</h5>
              <a href="<?php echo $contact_data['gmap']?>" class="d-inline-block text-decoration-none text-dark mb-2" target ="_blank">
              <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_data['address']?>
              </a>

              <h5 class = "mt-4">Call us</h5>
              <a class="d-inline-block mb-4 text-decoration-none text-dark" href="tel:+<?php echo $contact_data['pn1']?>"> 
                <i class="bi bi-telephone-fill me-1"></i>+<?php echo $contact_data['pn1']?>
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

                <h5 class="mt-4">Email us</h5>
                <a class="d-inline-block mb-3" href="<?php echo $contact_data['fb']?>" target = "_blank">
                  <span class="badge bg-light text-dark p-2 fs-6">
                    <i class="bi bi-facebook me-1"></i>Facebook
                  </span>
                </a><br>
                <a class="d-inline-block mb-3" href="<?php echo $contact_data['insta']?>" target = "_blank">
                  <span class="badge bg-light text-dark p-2 fs-6">
                    <i class="bi bi-instagram me-1"></i>Instagram
                  </span>
                </a><br>
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
                  ?>
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