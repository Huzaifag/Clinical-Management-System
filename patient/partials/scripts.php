<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
var chartData = <?php echo json_encode($chartData); ?>;
</script>
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
$("#dismissBtn").hide();

setTimeout(function(){
        var alertElement = document.querySelector('.custem-alert');
        if(alertElement)
            alertElement.remove();
    }, 2000);
    
    
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('patientChart').getContext('2d');
      var labels = chartData.map(item => item.date);
      var data = chartData.map(item => item.count);

      var chart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: labels,
              datasets: [{
                  label: 'New Patients',
                  data: data,
                  borderColor: 'rgb(75, 192, 192)',
                  tension: 0.1
              }]
          },
          options: {
              responsive: true,
              scales: {
                  y: {
                      beginAtZero: true,
                      ticks: {
                          stepSize: 1
                      }
                  }
              }
          }
      });

      // Update total patients this week
      var totalPatientsThisWeek = data.reduce((a, b) => a + b, 0);
      document.querySelector('.display-4').textContent = totalPatientsThisWeek;

      // Calculate percentage change
      var percentageChange = ((data[data.length - 1] - data[0]) / data[0] * 100).toFixed(2);
      var percentageElement = document.querySelector('.text-success span');
      percentageElement.textContent = percentageChange + '%';
      
      if (percentageChange < 0) {
          percentageElement.classList.remove('text-success');
          percentageElement.classList.add('text-danger');
          document.querySelector('.bi-arrow-up').classList.replace('bi-arrow-up', 'bi-arrow-down');
      }
  });
</script>