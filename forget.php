<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Clinic - FORGET PASSWORD</title>
  <?php require('partials/links.php');?> 
</head>
<body class="bg-light">
  <?php require('partials/header.php');?>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <img src="images/Forgot_password.gif" class="img-fluid" alt="...">
      </div>
      <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
        <form class="card shadow-sm p-5" method="post">
          <h2 class="text-center mb-4">FORGET PASSWORD</h2>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <button type="submit" name="resetPass" class="btn btn-primary btn-lg">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
  <?php require('partials/footer.php')?>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



function sendMail($email, $v_code){
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = "huzaifa6715@gmail.com";                // SMTP username from environment variable
        $mail->Password   = 'xxxx xxxx xxxx xxxx';                 // SMTP password from environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to
    
        // Recipients
        $mail->setFrom('huzaifa6715@gmail.com', 'Huzaifa Gulzar');
        $mail->addAddress($email);                                  // Add a recipient
    
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Email Verification from Huzaifa Gulzar';
        $mail->Body    = "
                            <h2>Your Verification Code</h2>
                            Don't share this code with anyone
                            <h2>$v_code</h2>
        ";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['resetPass'])){
    // Sanitize email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Ensure $conn is defined and connected
        $conn = mysqli_connect("localhost", "root", "", "cms"); // Add your database details

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $v_code = rand(1000, 9999);
        $verify_user_query = "SELECT * FROM `patient` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $verify_user_query);
        
        if(mysqli_num_rows($result) > 0){
            $query = "INSERT INTO `reset_pass`(`verify_code`, `user_email`) VALUES ('$v_code', '$email')";
            $result = mysqli_query($conn, $query);
            
            if($result && sendMail($email, $v_code)){
                echo "<script>
                        alert('Check your email to verify');
                        window.location.href='resetPass.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error: Unable to send verification email.');
                        window.location.href='forget.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('User does not exist');
                    window.location.href='forget.php';
                  </script>";
        }

        mysqli_close($conn); // Close the database connection
    } else {
        echo "<script>
                alert('Invalid email address');
                window.location.href='forget.php';
              </script>";
    }
}
?>
