let general_data;

let general_s_form = document.getElementById('general_s_form');
let contact_s_form = document.getElementById('contact_s_form');


let site_title_input = document.getElementById('site_title_input') ;
let site_about_input = document.getElementById('site_about_input');


function get_general(){
  let site_title = document.getElementById('site_title');
  let site_about = document.getElementById('site_about');
  let shutdown_toggle = document.getElementById('shutdown_toggle');
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    general_data = this.responseText;
    general_data = JSON.parse(general_data);
    site_title.innerText = general_data.site_title;
    site_about.innerText = general_data.about_us;
    site_title_input.value = general_data.site_title;
    site_about_input.value = general_data.about_us;
    if(general_data.shutdown == 0){
      shutdown_toggle.checked = false;
      shutdown_toggle.value =0;
    }
    else{
      shutdown_toggle.checked = true;
      shutdown_toggle.value =1;
    }
  }
  xhr.send('get_general'); 
}

//update date through modal
function upd_general(site_title_val, site_about_val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if(this.responseText == 1){
      showAlert('success','data has been updated');
    }
    else{
      showAlert('danger', 'data has been not updated');
    }
    get_general(); // Call get_general() after the update is complete
    var modalEl = document.getElementById('general-s');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
  }
  xhr.send('site_title=' + site_title_val + '&site_about=' + site_about_val + '&upd_general');
}

general_s_form.addEventListener('submit', function(e){
  e.preventDefault();
    upd_general(site_title_input.value, site_about_input.value);
})

// shutdown website 
function upd_shutdown(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    console.log("Response from server:", this.responseText);
    if (this.responseText == 1) {
      showAlert('success', 'Website has been shutdown');
    } else {
      showAlert('success', 'Shutdown mode has been off!');
    }
    get_general();
  };
  xhr.send('upd_shutdown=' + val);
}

function get_schedule(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    document.getElementById('time_data').innerHTML = this.responseText;
    
  }
  xhr.send('get_schedule'); 
}
let is_closed = document.getElementById('is_closed');

function upd_schd(val){
  document.getElementById('schedule_id').value = val;
}

        is_closed.addEventListener('change', function() {
            if (this.checked) {
                this.value = 1;
            } else {
                this.value = 0;
            }
        });

        schedule_s_form.addEventListener('submit', function(e){
          e.preventDefault();
            upd_schedule();
        })

        function upd_schedule() {
          let opening_time_input = document.getElementById('opening_time_input');
          let closing_time_input = document.getElementById('closing_time_input');
          let is_closed = document.getElementById('is_closed');
          let schedule_id = document.getElementById('schedule_id');
          
          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/settings_crud.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          
          xhr.onload = function() {
            console.log("Response from server:", this.responseText);
            if (this.responseText == 1) {
              showAlert('success', 'Schedule has been changed');
            } else {
              showAlert('error', 'Something went wrong!');
            }
            get_schedule(); // Assuming this function updates the schedule view after successful update
            var modalEl = document.getElementById('schedule-s');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
          };
          
          xhr.send('opening_time=' + opening_time_input.value + '&closing_time=' + closing_time_input.value + '&is_closed=' + is_closed.value + '&schedule_id=' + schedule_id.value + '&upd_schedule=');
        }
        
// show contacts data on page 
function get_contact(){
  let contact_p_id = ['address', 'gmap', 'phone1', 'phone2','email','fb','insta','tw'];
  let iframe = document.getElementById('iframe');
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    contacts_data = this.responseText;
    contacts_data = JSON.parse(contacts_data);
    contacts_data = Object.values(contacts_data);
    console.log(contacts_data);
    for(i=0 ; i<contact_p_id.length; i++){
      document.getElementById(contact_p_id[i]).innerText = contacts_data[i+1];
    }
    iframe.src = contacts_data[9];
    contact_input(contacts_data);
  }
  xhr.send('get_contact');
}

// update general settings
function contact_input(data){
  let contact_form_id = ['address_input', 'gmap_input', 'phone1_input', 'phone2_input','email_input','fb_input','insta_input','tw_input', 'iframe_input'];
  for(i=0 ; i<contact_form_id.length; i++){
    document.getElementById(contact_form_id[i]).value = data[i+1];
  }
}

contact_s_form.addEventListener('submit', function(e){
  e.preventDefault();
  upd_contacts();
})

// update contacts settings
function upd_contacts(){
  let index = ['address', 'gmap', 'phone1', 'phone2','email','fb','insta','tw', 'iframe'];
  let contact_form_id = ['address_input', 'gmap_input', 'phone1_input', 'phone2_input','email_input','fb_input','insta_input','tw_input', 'iframe_input'];
  let data_str = "";
  for(i=0; i<index.length; i++){
    data_str += index[i] + "=" + document.getElementById(contact_form_id[i]).value + "&";
  }
  data_str += 'udp_contacts';
  console.log(data_str);
  xhr =new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    var modalEl = document.getElementById('contact-s');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
    console.log("Response from server:", this.responseText);
    if (this.responseText == 1) {
      showAlert('success', 'Changes has been made!');       
      get_contact();
    } else {
      showAlert('error', 'No changes has been made!');
    }
}
xhr.send(data_str);
}


window.onload = function(){
  get_general();
  get_schedule();
  get_contact();
  // get_team();
}