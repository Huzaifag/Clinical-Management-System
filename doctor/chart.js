let data = [];

function get_appointments() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/charts.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            console.log(this.responseText);
            data = JSON.parse(this.responseText);
            generateChart(); // Call the function to generate the chart after data is fetched
        } else {
            console.error('Error fetching data.');
        }
    };
    xhr.send('get_appointments=1'); // Send 'get_appointments=1' as the POST data
}

get_appointments();

function generateChart() {
    // Get today's date
    const today = new Date();

    // Helper function to get a date string in YYYY-MM-DD format
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    // Generate the last 7 days
    const last7Days = [];
    for (let i = 0; i < 7; i++) {
        const day = new Date(today);
        day.setDate(today.getDate() - i);
        last7Days.unshift(formatDate(day));
    }

    // Aggregate data for the last 7 days
    const aggregatedData = last7Days.reduce((acc, date) => {
        acc[date] = data.filter(appointment => appointment.date === date).length;
        return acc;
    }, {});

    const labels = Object.keys(aggregatedData);
    const counts = Object.values(aggregatedData);

    // Create the chart
    const ctx = document.getElementById('appointmentsChart').getContext('2d');
    const appointmentsChart = new Chart(ctx, {
        type: 'bar', // Use 'line' or 'bar' depending on your preference
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Appointments',
                data: counts,
                backgroundColor: 'rgba(76, 59, 207, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                duration: 2000, // Duration of animation in milliseconds
                easing: 'easeOutBounce' // Easing function
            },
            scales: {
                y: {
                    beginAtZero: false, // Ensure the y-axis starts at 0
                    ticks: {
                        stepSize: 5, // Set the step size for the ticks
                        suggestedMin: 0,
                        suggestedMax: 30
                    }
                }
            }
        }
    });
}
