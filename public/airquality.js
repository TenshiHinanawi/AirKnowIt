document.getElementById('theme-toggle').addEventListener('click', function () {
    const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    window.location.href = `/set-theme/${newTheme}`;
});

Chart.defaults.color = '#4CAF50';
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'PM2.5',
                data: pm2_5,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'PM10',
                data: pm10,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'O3',
                data: o3,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'SO2',
                data: so2,
                borderColor: 'rgb(153, 102, 255)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'CO',
                data: co,
                borderColor: 'rgb(255, 159, 64)',
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
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
                text: `Historical Air Quality of ${locationName}`,
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
                    text: 'Air Quality (µg/m³ or ppm)'
                }
            }
        }
    }
});


const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'PM2.5',
                data: pm2_5,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            },
            {
                label: 'PM10',
                data: pm10,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Air Quality Comparison - ${locationName}`,
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
                    text: 'Air Quality (µg/m³)'
                }
            }
        }
    }
});
