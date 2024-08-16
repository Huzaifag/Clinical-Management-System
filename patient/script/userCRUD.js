const id = document.getElementById('userId').value;
const user_form = document.getElementById('user_form');
let userData = [];
const editBtn = document.getElementById('editBtn');
const name = document.getElementById('name_inp');
const email = document.getElementById('email_inp')
const phone = document.getElementById('pn_inp')
const address = document.getElementById('address_inp');
const dob = document.getElementById('date_inp');
const gender = document.getElementById('gender_inp');

function getUserData() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/user_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (this.status === 200) {
      console.log(this.responseText);
      userData = JSON.parse(this.responseText);
      console.log(userData);
      document.getElementById('name_el').innerText = userData.name;
      document.getElementById('email_el').innerText = userData.email;
      document.getElementById('phone_el').innerText = `0${userData.pn}`;
      document.getElementById('gender_el').innerText = userData.gender;
      document.getElementById('address_el').innerText = userData.address;
      document.getElementById('bDate_el').innerText = userData.dob;
    } else {
      console.error('Error fetching user data:', this.statusText);
    }
  }
  xhr.send('userId=' + id); 
}
editBtn.addEventListener("click", ()=>{
  name.value = userData.name;
  email.value = userData.email;
  phone.value = userData.pn;
  address.value = userData.address;
  dob.value = userData.dob;
  gender.value = userData.gender;
})
user_form.addEventListener('submit', (e)=>{
  e.preventDefault();
  update_data();
})
function update_data() {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'ajax/user_crud.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  xhr.onload = () => {
    console.log('Response received:', xhr.responseText); 
    
    if (xhr.responseText.trim() === '1') { 
      alert('Profile has been updated successfully...');
      var modalEl = document.getElementById('editModal');
      var modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();
      getUserData();
    } else {
      alert('Error updating profile: ' + xhr.responseText);
    }
  };
  
  xhr.send(
    'patientId=' + id + 
    '&name=' + encodeURIComponent(name.value) + 
    '&email=' + encodeURIComponent(email.value) +
    '&gender=' + encodeURIComponent(gender.value) +
    '&phone=' + encodeURIComponent(phone.value) +
    '&address=' + encodeURIComponent(address.value) +
    '&dob=' + encodeURIComponent(dob.value)
  );
}
window.onload = function() {
  getUserData();  
}

