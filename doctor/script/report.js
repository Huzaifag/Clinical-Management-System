let report_form = document.getElementById('report_form');
report_form.addEventListener('submit' ,function(e){
  e.preventDefault();
  add_report();
})

function add_report(){
  let data = new FormData();
  data.append('add_report', '');
  data.append('bp', report_form.elements['bp'].value);
  data.append('temp', report_form.elements['temp'].value);
  data.append('height', report_form.elements['height'].value);
  data.append('b_sugar', report_form.elements['b_sugar'].value);
  data.append('pulse', report_form.elements['pulse'].value);
  data.append('weight', report_form.elements['weight'].value);
  data.append('chief_complaint', report_form.elements['chief_complaint'].value);
  data.append('medical_prescription', report_form.elements['medical_prescription'].value);
  data.append('patient_id', report_form.elements['patient_id'].value);
  

  let symptoms = [];
  report_form.elements['symptoms'].forEach(symptom => {
    if(symptom.checked){
      symptoms.push(symptom.value);
    }
  });


  data.append('symptoms', JSON.stringify(symptoms));
  

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/report_crud.php", true);
  xhr.onload = function() {
    if(xhr.responseText == 1){
      alert('success', 'New Report has been added');
      get_reports();

    }
    else{
      alert('error', 'Something went wrong');
    }
    var modalEl = document.getElementById('newRoprt');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
  }
  xhr.send(data);
}

function get_reports(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/report_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
        document.getElementById('report_data').innerHTML = this.responseText;
    };
    let patientId = report_form.elements['patient_id'].value;
    xhr.send('get_reports=' + patientId);
}

function rem_report(rId){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/report_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
       if(this.responseText == 1){
        alert('Report has been deleted');
        get_reports();
       }
       else{
        alert('Something went wrong');
        }
        
    };
    
    xhr.send('rem_report=' + rId);
}

window.onload = function(){
  get_reports();
}