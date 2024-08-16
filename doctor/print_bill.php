<?php
  require("partials/essentials.php");
  require("partials/db_config.php");

  doctorLogin();
  session_regenerate_id(true);
  //Doctor Data

  // General Data
  $general = selectAll('generals');
  $general_data = mysqli_fetch_assoc($general);
  $clinic_title = $general_data['site_title'];
  // Contact Data
  $contact = selectAll('contact_details');
  $contact_data = mysqli_fetch_assoc($contact);
  $phone1 = $contact_data['pn1'];
  $phone2 = $contact_data['pn2'];
  $email = $contact_data['email'];
  $address = $contact_data['address'];
  // bill Data 
  $bill_q = 'SELECT * FROM `bills` WHERE `bill_id` = ?';
  $value = [$_GET['bill_id']];
  $bill = select($bill_q, $value, 'i');
  $bill_data = mysqli_fetch_assoc($bill);
  $pateint_id = $bill_data['patient_id'];
  $bill_date = $bill_data['date'];
  // Patient Data
  $patient_q = 'SELECT * FROM `patient` WHERE `id` = ?';
  $value = [$pateint_id];
  $patient = select($patient_q, $value, 'i');
  $patient_data = mysqli_fetch_assoc($patient);
  $patient_name = $patient_data['name'];
  $patient_dob = $patient_data['dob'];
  $patient_sex = $patient_data['gender'];
  $patient_reg_date = $patient_data['date'];
  // Calculating Age
  $today = new DateTime('today');
  $dob = new DateTime($patient_dob);
  $age = $dob->diff($today)->y;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient - Test Report</title>
  <?php require('partials/links.php');?>
  <link rel="stylesheet" href="css/report.css">
  <style>
        body{
          background-color: rgba(255, 255, 255, 0.5);
          background-image: url(pic/billbg.png);
          background-size: 50%;
          background-repeat: no-repeat;
          background-position: bottom;
          min-height: 900px;
        }
  </style>
</head>
<body>
<button class="btn btn-white ms-4 shadow-none print-button btn-sm mt-3" onclick="printPage()">
    <i class="bi bi-printer-fill text-dark"></i> Print
  </button>
  
  <div class="container-fluid header px-4">
    <div class="report_header">
      <div class="logo">
        <img src="pic/logo.png" alt="">
      </div>
      <div class="clinic_title ms-4">
        <?php
         echo '<h6 class="h-font p-0 m-0 mb-2">'.$clinic_title.'</h6>';
        ?>
        <p class="text-info fw-bold m-0 p-0">Gynecology | Obstetrics | ENT | MRI</p>
        <span class="badge rounded-pill bg-light text-dark"><?php echo $address; ?></span>
      </div>
      <div class="clinic_contact">
        <p class="p-0 m-0 phones"><i class="bi bi-telephone-fill text-success"></i> <?php echo $phone1. ' | '. $phone2; ?></p>
        <p class="p-0 m-0 email"><i class="bi bi-envelope-at-fill text-success"></i> <?php echo $email ;?></p>
      </div>
    </div>
    <div class="Patient_data row mt-3 pb-3">
      <div class="col-4 p-data">
        <h3 class="patient_name"><?php echo $patient_name;?></h3>
        <p>Age: <?php echo $age;?> years</p>
        <p>Sex: <?php echo $patient_sex;?></p>
      </div>
      <div class="col-4 p-data">
        <p><span class="fw-bold">Patient_Id:</span> <?php echo $pateint_id;?></p>
        <p>Bill_Id: <?php echo $_GET['bill_id'];?></p>
      </div>
      <div class="col-4">
        <h6>Regester on:</h6>
        <p><?php echo $patient_reg_date;?></p>
        <h6>Bill on:</h6>
        <p><?php echo $bill_date;?></p>
      </div>
    </div>
    <div class="bill_data row mt-3 pb-3">
    <div class="table-responsive-md mt-2">
      <table class="table">
                  <thead>
                    <tr class="bg-info text-white text-center">
                      <th scope="col">Doctor Fees</th>
                      <th scope="col">Medicine</th>
                      <th scope="col">Lab Test</th>
                      <th scope="col">Total</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody id="bill_data">
                    <?php
                        echo '
                          <tr class="text-center">
                            <td>'.$bill_data['doc_fees'].'</td>
                            <td>'.$bill_data['medicine'].'</td>
                            <td>'.$bill_data['lab_test'].'</td>
                            <td>'.$bill_data['total'].'</td>
                            <td>'.$bill_data['date'].'</td>
                          </tr>
                        ';
                    ?>
                  </tbody>
      </table>
    </div>
    </div>


  </div>
  <script>
    window.onbeforeprint = function() {
      var printButton = document.querySelector('.print-button');
      printButton.style.display = 'none';
    };

    window.onafterprint = function() {
      var printButton = document.querySelector('.print-button');
      printButton.style.display = 'block';
    };
    function printPage() {
      window.print();
    }
    function get_symptoms() {
      let report_id = document.getElementById('report_id').value;
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/report_crud.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        console.log(data);
        // Ensure symptom_form is referencing the correct form
        let symptom_form = document.getElementById('symptom_form');
        // Loop through symptoms checkboxes and check them based on data
        
        Array.from(symptom_form.elements['symptoms']).forEach(element => {
          //console.log(element);
          if(data.symptoms.includes(Number(element.value))){
            //console.log(data.symptoms.includes(Number(element.value)));
            element.checked = true;
          } 
        });

      };
      xhr.send('get_symptoms=' + report_id);
    }

    window.onload = function(){
      get_symptoms()
    }
  </script>  
</body>
</html>