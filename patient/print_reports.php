<?php
  require("partials/db_config.php");
  require("partials/essentials.php");
  patientLogin();
  session_regenerate_id(true);
  $patient_id = $_SESSION['userId'];
  $patient_name = $_SESSION['username'];
  
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
  // Report Data 
  $report_q = 'SELECT * FROM `reports` WHERE `id` = ?';
  $value = [$_GET['report_id']];
  $report = select($report_q, $value, 'i');
  $report_data = mysqli_fetch_assoc($report);
  $doctor_id = $report_data['doctor_id'];
  $report_date = $report_data['date'];
  //Doctor Data
  $doctor_q = 'SELECT * FROM `doctor` WHERE `id` = ?';
  $value = [$doctor_id];
  $doctor = select($doctor_q, $value, 'i');
  $doctor_data = mysqli_fetch_assoc($doctor);
  $doctor_name = $doctor_data['name'];
  // Patient Data
  $patient_q = 'SELECT * FROM `patient` WHERE `id` = ?';
  $value = [$patient_id];
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
  <title>Patient - Report</title>
  <?php require('partials/links.php');?>
  <link rel="stylesheet" href="css/report.css">
  <style>
        body{
          background-color: rgba(255, 255, 255, 0.5);
          background-image: url(pic/reportbg.png);
          background-size: 50%;
          background-repeat: no-repeat;
          background-position: center;
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
        <p><span class="fw-bold">Patient_Id:</span> <?php echo $patient_id;?></p>
        <p>Report_Id: <?php echo $_GET['report_id'];?></p>
        <p class="fw-bold">Ref. By: Dr <?php echo $doctor_name;?></p>
      </div>
      <div class="col-4">
        <h6>Regester on:</h6>
        <p><?php echo $patient_reg_date;?></p>
        <h6>Report on:</h6>
        <p><?php echo $report_date;?></p>
      </div>
    </div>
    <div class="report_data row mt-3 pb-3">
      <table class="table table-bordered">
        <tbody >
          <tr>
            <th scope="row">Blood Pressure</th>
            <td><?php echo  $report_data['bp']; ?> (mmHg)</td>
            <th scope="row">Blood Sugar</th>
            <td><?php echo  $report_data['b_sugar']; ?> (mg/dL)</td>
          </tr>
          <tr>
            <th scope="row">Blody Temprature</th>
            <td><?php echo  $report_data['temp']; ?> (°C)</td>
            <th scope="row">Pulse</th>
            <td><?php echo  $report_data['pulse']; ?>  (bpm)</td>
          </tr>
          <tr>
            <th scope="row">Height</th>
            <td><?php echo  $report_data['height']; ?> (ft, in)</td>
            <th scope="row">Weight</th>
            <td><?php echo  $report_data['weight']; ?> (Kg)</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="symptoms row pb-3">
      <h4>Symptoms:</h4>
      <div class="row">
        <form id="symptom_form">
        <?php
            $symptoms_list = selectAll('symptoms');
            while ($symptoms = mysqli_fetch_assoc($symptoms_list)) {
                echo '<div class="checkbox-container">';
                echo '<input class="form-check-input shadow-none" type="checkbox" value="' . $symptoms['id'] . '" name="symptoms">';
                echo '<label for="fever1">' . $symptoms['symptom'] . '</label>';
                echo '</div>';
            }
        ?>
        <input type="text" value = "<?php echo $_GET['report_id']; ?>" id="report_id" name="report_id" hidden>

        </form>
      </div>
    </div>
    <div class="medical_prescription row pb-3 justify-content-between">
      <div class="col-5">
        <h4>Chief Complaints</h4>
        <p><?php echo $report_data['chief_complaint']; ?></p>
      </div>
      <div class="col-5">
        <h4>Medical Prescription</h4>
        <p><?php echo $report_data['medical_prescription']; ?></p>
      </div>
      
    </div>
    <div class="disclaimer row mt-3">
      <div class="col-6">
        <h4>Medical Report Disclaimer</h4>
        <ul class="desc">
          <li>Educational tool for learning and demonstration.</li>
          <li>Not a medical diagnosis or treatment plan.</li>
          <li>Not for clinical decision making.</li>
        </ul>
      </div>
      <div class="col-6 text-center">
        <h4 class="mb-4">Doctor Signature</h4>
        <h5><u>Dr <?php echo $doctor_data['name'];?></u></h5>
        <p>(<?php echo $doctor_data['Specialization'];?>)<p>  
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
      get_symptoms();
    }
  </script>  
</body>
</html>