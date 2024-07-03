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
      var patientData = <?php echo $chartData; ?>;
      
      const today = new Date();

      // Function to get day name
      function getDayName(date) {
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return days[date.getDay()];
      }

      const last7Days = [];
      for (let i = 0; i < 7; i++) {
        const day = new Date(today);
        day.setDate(today.getDate() - i);
        last7Days.unshift(getDayName(day)); // Use day names instead of formatted dates
      }

      const aggregatedData = last7Days.reduce((acc, dayName) => {
        // Filter patient data by day name
        acc[dayName] = patientData.filter(patient => {
          const patientDate = new Date(patient.date);
          return getDayName(patientDate) === dayName;
        }).length;
        return acc;
      }, {});

      const labels = Object.keys(aggregatedData);
      const counts = Object.values(aggregatedData);

      const patientsChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'No of Patients',
            data: counts,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 1,
            tension: 0.4
          }]
        },
        options: {
          animation: {
            duration: 2000,
            easing: 'easeOutBounce'
          },
          scales: {
            y: {
              beginAtZero: false,
              ticks: {
                stepSize: 5,
                suggestedMin: 0,
                suggestedMax: 10
              }
            }
          },
          plugins: {
            tooltip: {
              enabled: false
            }
          },
          interaction: {
            mode: 'nearest',
            intersect: false,
            axis: 'x'
          }
        }
      });
    });
  </script>
