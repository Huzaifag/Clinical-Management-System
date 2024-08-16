const id = document.getElementById('userId').value;
const user_form = document.getElementById('user_form');
let userData = [];
const editBtn = document.getElementById('editBtn');
const name = document.getElementById('name_inp');
const email = document.getElementById('email_inp')
const phone = document.getElementById('pn_inp')
const address = document.getElementById('address_inp');
const fees = document.getElementById('fees_inp');
const specialization = document.getElementById('specialization_inp');

function getUserData() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/profile_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (this.status === 200) {
      console.log(this.responseText);
      userData = JSON.parse(this.responseText);
      console.log(userData);
      document.getElementById('name_el').innerText = userData.name;
      document.getElementById('email_el').innerText = userData.email;
      document.getElementById('phone_el').innerText = `+${userData.pn}`;
      document.getElementById('specialization_el').innerText = userData.Specialization;
      document.getElementById('address_el').innerText = userData.address;
      document.getElementById('fees_el').innerText = userData.fees;
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
  fees.value = userData.fees;
  specialization.value = userData.Specialization;
})
user_form.addEventListener('submit', (e)=>{
  e.preventDefault();
  update_data();
})
function update_data() {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'ajax/profile_crud.php', true);
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
    'doctorId=' + id + 
    '&name=' + encodeURIComponent(name.value) + 
    '&email=' + encodeURIComponent(email.value) +
    '&fees=' + encodeURIComponent(fees.value) +
    '&phone=' + encodeURIComponent(phone.value) +
    '&address=' + encodeURIComponent(address.value) +
    '&specialization=' + encodeURIComponent(specialization.value)
  );
}
window.onload = function() {
  getUserData();  
}

