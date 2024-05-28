<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
function showAlert(type, msg, position = 'body') {
  // Remove any existing alerts
  let existingAlert = document.querySelector('.custem-alert');
  if (existingAlert) {
    existingAlert.remove();
  }

  // Create and append the new alert
  let bsClass = (type === 'success') ? 'alert-success' : 'alert-danger';
  let element = document.createElement('div');
  let settings = document.getElementById('alert_div');
  element.innerHTML = `
    <div class="alert ${bsClass} alert-dismissible fade show" role="alert">
      <strong>${msg}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;

  if (position === 'body') {
    // appending the element to the body
    settings.insertAdjacentElement('afterbegin', element);
    element.classList.add('custem-alert')
  } else {
    document.getElementById(position).appendChild(element);
  }
}

function setActive() {
        let nav = document.getElementById('nav-bar');
        let a_tags = nav.getElementsByTagName('a');
        for (let index = 0; index < a_tags.length; index++) {
          let file = a_tags[index].href.split('/').pop();
          let file_name = file.split('.')[0];
          if (document.location.href.indexOf(file_name) >= 0) {
            a_tags[index].classList.add('active');
          }
        }
}
setActive();
</script>