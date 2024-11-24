document.getElementById('theme-toggle').addEventListener('click', function () {
    const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    window.location.href = `/set-theme/${newTheme}`;
});

Chart.defaults.color = '#4CAF50';
const ctxLine = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Temperature (°C)',
            data: temperatures,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: false,
            tension: 0.1
        },
        {
            label: 'Feels Like (°C)',
            data: feelsLike,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: false,
            tension: 0.1
        }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Historical Temperature of ${locationName}`,
                font: {
                    size: 18
                }
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Date/Time'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Temperature (°C)'
                }
            }
        }
    }
});

const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Humidity (%)',
            data: humidity,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Humidity Levels at ${locationName}`,
                font: {
                    size: 18
                }
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Date/Time'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Humidity (%)'
                }
            }
        }
    }
});

const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
const doughnutChart = new Chart(ctxDoughnut, {
    type: 'doughnut',
    data: {
        labels: ['Low Wind Speed', 'Moderate Wind Speed', 'High Wind Speed'],
        datasets: [{
            data: [
                windSpeed.filter(ws => ws < 5).length,
                windSpeed.filter(ws => ws >= 5 && ws < 15).length,
                windSpeed.filter(ws => ws >= 15).length
            ],
            backgroundColor: ['rgb(75, 192, 192)', 'rgb(255, 159, 64)', 'rgb(255, 99, 132)'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Wind Speed Distribution at ${locationName}`,
                font: {
                    size: 18
                }
            }
        }
    }
});

const ctxRadar = document.getElementById('radarChart').getContext('2d');
const radarChart = new Chart(ctxRadar, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Temperature (°C)',
            data: temperatures,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true
        },
        {
            label: 'Humidity (%)',
            data: humidity,
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: true
        },
        {
            label: 'Pressure (hPa)',
            data: pressure,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Weather Comparison at ${locationName}`,
                font: {
                    size: 18
                }
            }
        }
    }
});
