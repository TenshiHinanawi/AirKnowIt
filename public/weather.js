document.getElementById('theme-toggle').addEventListener('click', function () {
    const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    window.location.href = `/set-theme/${newTheme}`;
});

Chart.defaults.color = '#4CAF50';
const ctxLine = document.getElementById('temp').getContext('2d');
const lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Temperature (°C)',
            data: temperatures,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: false,
            tension: 0.1
        },
        {
            label: 'Feels Like (°C)',
            data: feelsLike,
            borderColor: 'rgb(255, 200, 132)',
            backgroundColor: 'rgba(255, 200, 132, 0.2)',
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

const ctxBar = document.getElementById('humidity').getContext('2d');
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
                text: `Historical Humidity Levels at ${locationName}`,
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

const ctxBar1 = document.getElementById('wind').getContext('2d');
const wind = new Chart(ctxBar1, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Wind Speed (m/s)',
            data: windSpeed,
            backgroundColor: 'rgba(19, 100, 255, 0.2)',
            borderColor: 'rgb(19, 100, 255)',
            borderWidth: 1
        },
        {
            label: 'Wind Gust (m/s)',
            data: gust,
            backgroundColor: 'rgba(135, 206, 200, 0.2)',
            borderColor: 'rgb(135, 206, 200)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: `Historical Wind Speed at ${locationName}`,
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
                    text: 'Wind Speed (m/s)'
                }
            }
        }
    }
});

const weatherElement = document.getElementById('weather-description');
if (weather.length > 0) {
    weatherElement.innerText = `Weather: ${weather[0]}`;
    if (weather[0] == "scattered clouds") {
        weatherElement.innerText = `Weather: Scattered Clouds`;
    }
    if (weather[0] == "few clouds") {
        weatherElement.innerText = `Weather: Few Clouds`;
    }
    if (weather[0] == "broken clouds") {
        weatherElement.innerText = `Weather: Broken Clouds`;
    }
    if (weather[0] == "clear sky") {
        weatherElement.innerText = `Weather: Clear Sky`;
    }
    if (weather[0] == "shower rain") {
        weatherElement.innerText = `Weather: Rain Shower`;
    }
    if (weather[0] == "rain") {
        weatherElement.innerText = `Weather: Rain`;
    }
    if (weather[0] == "thunderstorm") {
        weatherElement.innerText = `Weather: Thunderstorm`;
    }
    if (weather[0] == "snow") {
        weatherElement.innerText = `Weather: Snow`;
    }
    if (weather[0] == "mist") {
        weatherElement.innerText = `Weather: Mist`;
    }
} else {
    weatherElement.innerText = 'Weather data not available';
}

