let test_form = document.getElementById('test_form');
test_form.addEventListener('submit' ,function(e){
  e.preventDefault();
  add_report();
})

function add_report() {
  let data = new FormData();
  data.append('add_report', '');
  data.append('ex_type', test_form.elements['ex_type'].value);
  data.append('probe', test_form.elements['probe'].value);
  data.append('reason', test_form.elements['reason'].value);
  data.append('image', test_form.elements['image'].files[0]);
  data.append('findings', test_form.elements['findings'].value);
  data.append('recommendations', test_form.elements['recommendations'].value);
  data.append('patient_id', test_form.elements['patient_id'].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/test_crud.php", true);
  xhr.onload = function() {
      if (xhr.status === 200) {
          if (xhr.responseText === '1') {
              alert('success', 'New Report has been added');
              test_form.reset();
              get_reports();
          } else {
              alert('error', 'Something went wrong');
          }
      } else {
          alert('error', 'Error: ' + xhr.status);
      }
      var modalEl = document.getElementById('newReport'); // Corrected the ID
      var modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();
  };
  xhr.onerror = function() {
      alert('error', 'Network error occurred');
  };
  xhr.send(data);
}


function get_reports(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/test_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
       // console.log(this.responseText);
        document.getElementById('test_data').innerHTML = this.responseText;
    };
    let patientId = test_form.elements['patient_id'].value;
    xhr.send('get_reports=' + patientId);
}

function rem_report(rId){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/test_crud.php", true);
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