
let staff_s_form = document.getElementById('staff_s_form');


staff_s_form.addEventListener('submit' ,function(e){
  e.preventDefault();
   add_staff();
 })

 function add_staff() {
   let data = new FormData();
   data.append('staff_picture', staff_s_form.elements['staff_picture'].files[0]);

   let staff_data = ['name', 'role', 'pn','description', 'fb', 'insta', 'tw','address'];

   for(i=0; i<staff_data.length ; i++){
    data.append(staff_data[i], staff_s_form.elements[staff_data[i]].value);
   }
   
   data.append('add_staff', '');
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/staff_crud.php", true);
   xhr.onload = function() {
       if (this.status == 200) {
           if (this.responseText == 'inv_img') {
               showAlert('error', 'Invalid image type. Only SVG allowed');
           } else if (this.responseText == 'inv_size') {
               showAlert('error', 'Invalid image Size. Size Should be less than 1MB');
           } else if (this.responseText == 'upload_failed') {
               showAlert('error', 'Image failed to upload. Server Down');
           } else {
               showAlert('success', 'New Staff added Successfully');
               get_staff();
               staff_s_form.reset();
           }
           // Assuming Bootstrap is correctly included and initialized
           var modalEl = document.getElementById('staff-s');
           var modal = bootstrap.Modal.getInstance(modalEl);
           if (modal) {
               modal.hide();
           }
       }
   };
   xhr.send(data);
  }
 function get_staff(){
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/staff_crud.php", true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   xhr.onload = function(){
       console.log(this.responseText);
       document.getElementById('staff_data').innerHTML = this.responseText;
   };
   xhr.send('get_staff'); // Corrected the data being sent
}

function rem_staff(val) {
 let xhr = new XMLHttpRequest();
 xhr.open("POST", "ajax/staff_crud.php", true);
 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 
 xhr.onload = function() {
     if (xhr.status === 200) {
         if (xhr.responseText == 1) {
             showAlert('success', 'Staff Removed!');
             get_staff(); // Assuming this function reloads Staff list
         } else {
             showAlert('error', 'Failed to remove Staff.');
         }
     } else {
         showAlert('error', 'Something went wrong!');
     }
 };

 xhr.onerror = function() {
     showAlert('error', 'Network error occurred. Please try again.');
 };

 xhr.send('rem_staff=' + val);
}

window.onload = function(){
  get_staff();
}
