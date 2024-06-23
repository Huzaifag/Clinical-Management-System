
let doctors_s_form = document.getElementById('doctors_s_form');


doctors_s_form.addEventListener('submit' ,function(e){
  e.preventDefault();
   add_doctor();
 })

 function add_doctor() {
    let data = new FormData();
    data.append('doctor_picture', doctors_s_form['doctor_picture'].files[0]);

    let doctor_data = ['name', 'email', 'specialization', 'pn', 'date', 'address', 'fee', 'pass', 'cpass'];

    for (let i = 0; i < doctor_data.length; i++) {
        data.append(doctor_data[i], doctors_s_form[doctor_data[i]].value);
    }

    data.append('add_doctor', '');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/doctor_crud.php", true);
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'inv_img') {
                showAlert('error', 'Invalid image type. Only JPG, JPEG, PNG allowed');
            } else if (this.responseText == 'inv_size') {
                showAlert('error', 'Invalid image Size. Size Should be less than 2MB');
            } else if (this.responseText == 'upload_failed') {
                showAlert('error', 'Image failed to upload. Server Down');
            } else if (this.responseText == 2) {
                showAlert('error', 'Password and confirm password are not the same');
            } else {
                showAlert('success', 'New Doctor added Successfully');
                get_doctor();
                document.getElementById("doctors_s_form").reset(); // Reset the form
            }
            // Assuming Bootstrap is correctly included and initialized
            $('#doctors-s').modal('hide');
        }
    };
    xhr.send(data);
}

 function get_doctor(){
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/doctor_crud.php", true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   xhr.onload = function(){
       document.getElementById('doctors_data').innerHTML = this.responseText;
   };
   xhr.send('get_doctor'); // Corrected the data being sent
}

function set_doctor(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/doctor_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        console.log(this.responseText); // Log the response from the server
        
        if (xhr.status === 200) {
            if (this.responseText.trim() === '1') {
                alert('Changes have been made successfully');
                get_doctor(); // Assuming get_doctor() function reloads doctor list
            } else {
                alert('Something went wrong!'); // Handle errors
            }
        } else {
            alert('Request failed. Status: ' + xhr.status); // Handle HTTP errors
        }
    };

    xhr.onerror = function() {
        alert('Request failed. Check your network connection.'); // Handle network errors
    };
    
    xhr.send('set_doctor=' + id + '&value=' + val);
}


window.onload = function(){
    get_doctor();
}
