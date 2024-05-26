let carousal_s_form = document.getElementById('carousal-s-form');
let carousal_picture_input = document.getElementById('carousal_picture_input');
let facility_s_form = document.getElementById('facility-s-form');


carousal_s_form.addEventListener('submit' ,function(e){
e.preventDefault();
add_image();
})
  function add_image() {
    let data = new FormData();
    data.append('picture', carousal_picture_input.files[0]);
    data.append('add_image', '');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/customizations_crud.php", true);
    xhr.onload = function() {
      if (this.status == 200) {
        console.log(this.responseText);
        if(this.responseText == 'inv_img'){
          showAlert('error','Invalid image type. Only JPG and PNG allowed');
          }
          else if(this.responseText == 'inv_size'){
            showAlert('error','Invalid image Size. Size Should be less than 2MB');
          }
          else if(this.responseText == 'upload_failed'){
            showAlert('error','Image failed to uplaod. Server Down');
          }
          else{
            showAlert('success','New image added Successfully');
            
            carousal_picture_input.value = '';
            get_carousal();
          }
        var modalEl = document.getElementById('carousal-s');
      var modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();

      }
    }
    xhr.send(data);
  }

function get_carousal(){
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/customizations_crud.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onload = function(){
    // console.log(this.responseText);
    document.getElementById('carousal-data').innerHTML = this.responseText;
};
xhr.send('get_carousal'); // Sending data as key-value pair
}

function rem_image(val){
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/customizations_crud.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onload = function(){
  if(this.responseText == 1){
    showAlert('success', 'image Removed!');
    get_carousal();
  }
  else{
    showAlert('error', 'Something went wrong!');
  }
}
xhr.send('rem_image='+val);
}

facility_s_form.addEventListener('submit' ,function(e){
  e.preventDefault();
   add_facility();
 })

 function add_facility() {
   let data = new FormData();
   data.append('name', facility_s_form.elements['facility_name'].value);
   data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
   data.append('desc', facility_s_form.elements['facility_description'].value);
   data.append('add_facility', '');
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/customizations_crud.php", true);
   xhr.onload = function() {
     if (this.status == 200) {
   
   if(this.responseText == 'inv_img'){
     showAlert('error','Invalid image type. Only SVG allowed');
     }
     else if(this.responseText == 'inv_size'){
       showAlert('error','Invalid image Size. Size Should be less than 1MB');
     }
     else if(this.responseText == 'upload_failed'){
       showAlert('error','Image failed to uplaod. Server Down');
     }
     else{
       showAlert('success','New facility added Successfully');
       facility_s_form.reset();
       get_facility();
     }
         var modalEl = document.getElementById('facility-s');
         var modal = bootstrap.Modal.getInstance(modalEl);
         modal.hide();
     }
   }
   xhr.send(data);
 }

 function get_facility(){
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/customizations_crud.php", true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   xhr.onload = function(){
       console.log(this.responseText);
       document.getElementById('faciltily_data').innerHTML = this.responseText;
   };
   xhr.send('get_facility'); // Corrected the data being sent
}

function rem_facility(val) {
 let xhr = new XMLHttpRequest();
 xhr.open("POST", "ajax/customizations_crud.php", true);
 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 
 xhr.onload = function() {
     if (xhr.status === 200) {
         if (xhr.responseText == 1) {
             showAlert('success', 'Facility Removed!');
             get_facility(); // Assuming this function reloads facility list
         } else {
             showAlert('error', 'Failed to remove facility.');
         }
     } else {
         showAlert('error', 'Something went wrong!');
     }
 };

 xhr.onerror = function() {
     showAlert('error', 'Network error occurred. Please try again.');
 };

 xhr.send('rem_facility=' + val);
}

window.onload = function(){
  get_carousal();
  get_facility();
}
