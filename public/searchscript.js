// Theme toggle function
const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

function setTheme(isDark) {
    body.classList.toggle('dark-mode', isDark);
    body.classList.toggle('light-mode', !isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

// Load theme from localStorage
const savedTheme = localStorage.getItem('theme');
setTheme(savedTheme === 'dark');
themeToggle.checked = savedTheme === 'dark';

themeToggle.addEventListener('change', () => setTheme(themeToggle.checked));

document.getElementById("search-btn").addEventListener("click", fetchWeatherData);

async function fetchWeatherData() {
    const city = document.getElementById("city-search").value;
    const API_KEY = '49e2122f5c9da4368f1cd972696db508';

    // Fetch weather data
    const weatherResponse = await fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric`);
    const weatherData = await weatherResponse.json();

    // Fetch air quality data
    const airQualityResponse = await fetch(
        `https://api.openweathermap.org/data/2.5/air_pollution?lat=${weatherData.coord.lat}&lon=${weatherData.coord.lon}&appid=${API_KEY}`
    );
    const airQualityData = await airQualityResponse.json();

    updateWeatherInfo(weatherData);
    updateAirQualityInfo(airQualityData);
    updateCharts(airQualityData);
}

function updateWeatherInfo(data) {
    document.getElementById('search-location').textContent = `${data.name}, ${data.sys.country}`;
    document.getElementById('search-temperature').textContent = data.main.temp;
    document.getElementById('search-humidity').textContent = data.main.humidity;
    document.getElementById('search-pressure').textContent = data.main.pressure;
    document.getElementById('search-feels-like').textContent = data.main.feels_like;
    document.getElementById('search-temp-min').textContent = data.main.temp_min;
    document.getElementById('search-temp-max').textContent = data.main.temp_max;
    document.getElementById('search-visibility').textContent = data.visibility;
    document.getElementById('search-cloudiness').textContent = data.clouds.all;
    document.getElementById('search-wind-speed').textContent = data.wind.speed;
    document.getElementById('search-wind-gust').textContent = data.wind.gust || '--';
    document.getElementById('search-wind-direction').textContent = data.wind.deg;

    // Ensure weather data exists before using it
    if (data.weather && data.weather[0]) {
        document.getElementById('weather').textContent = data.weather[0].description;

        // Set the weather icon URL based on the condition code
        const weatherConditionCode = data.weather[0].icon;
        const iconUrl = `https://openweathermap.org/img/wn/${weatherConditionCode}@2x.png`;
        document.getElementById('weather-icon').innerHTML =
            `<img src="${iconUrl}" alt="${data.weather[0].description}" />`;
    }
}


function updateAirQualityInfo(data) {
    const statusElementPM2_5 = document.getElementById("search-pm25-status");
    const statusElementPM10 = document.getElementById("search-pm10-status");
    const statusElementO3 = document.getElementById("search-ozone-status");
    const statusElementSO2 = document.getElementById("search-sulfur-status");
    const statusElementNO = document.getElementById("search-nitro-status");
    const statusElementNO2 = document.getElementById("search-nitrodio-status");
    const statusElementCO = document.getElementById("search-carbon-status");
    const statusElementNH3 = document.getElementById("search-ammonia-status");



    const pm25 = data.list[0].components.pm2_5;
    const pm10 = data.list[0].components.pm10;
    const ozone = data.list[0].components.o3;
    const sulfur = data.list[0].components.so2;
    const nitro = data.list[0].components.no;
    const nitrodio = data.list[0].components.no2;
    const carbon = data.list[0].components.co;
    const ammonia = data.list[0].components.nh3;


    //pm25
    document.getElementById("search-pm25").textContent = `${pm25}`;
    document.getElementById("search-pm25-status").textContent = pm25 > 75 ? "Dangerous" : pm25 > 50 ? "Unhealthy" :
        pm25 > 25 ? "Moderate" : pm25 > 10 ? "Fair" : "Good";
    //coarse
    document.getElementById("search-pm10").textContent = `${pm10}`;
    document.getElementById("search-pm10-status").textContent = pm10 > 200 ? "Dangerous" : pm10 > 100 ?
        "Unhealthy" : pm10 > 50 ? "Moderate" : pm10 > 20 ? "Fair" : "Good";
    //ozone
    document.getElementById("search-ozone").textContent = `${ozone}`;
    document.getElementById("search-ozone-status").textContent = ozone > 180 ? "Dangerous" : ozone > 140 ?
        "Unhealthy" : ozone > 100 ? "Moderate" : ozone > 60 ? "Fair" : "Good";
    //sulfur
    document.getElementById("search-sulfur").textContent = `${sulfur}`;
    document.getElementById("search-sulfur-status").textContent = sulfur > 350 ? "Dangerous" : sulfur > 250 ?
        "Unhealthy" : sulfur > 80 ? "Moderate" : sulfur > 20 ? "Fair" : "Good";
    //nitro
    document.getElementById("search-nitro").textContent = `${nitro}`;
    document.getElementById("search-nitro-status").textContent = nitro > 150 ? "Dangerous" : nitro > 100 ?
        "Unhealthy" : nitro > 50 ? "Moderate" : nitro > 25 ? "Fair" : "Good";
    //nitrodio
    document.getElementById("search-nitrodio").textContent = `${nitrodio}`;
    document.getElementById("search-nitrodio-status").textContent = nitrodio > 200 ? "Dangerous" : nitrodio > 150 ?
        "Unhealthy" : nitrodio > 70 ? "Moderate" : nitrodio > 40 ? "Fair" : "Good";
    //carbon
    document.getElementById("search-carbon").textContent = `${carbon}`;
    document.getElementById("search-carbon-status").textContent = carbon > 15400 ? "Dangerous" : carbon > 12400 ?
        "Unhealthy" : carbon > 9400 ? "Moderate" : carbon > 4400 ? "Fair" : "Good";
    //ammonia
    document.getElementById("search-ammonia").textContent = `${ammonia}`;
    document.getElementById("search-ammonia-status").textContent = ammonia > 300 ? "Dangerous" : ammonia > 150 ?
        "Unhealthy" : ammonia > 50 ? "Moderate" : ammonia > 25 ? "Fair" : "Good";

    switch (statusElementPM2_5.textContent) {
        case "Dangerous":
            alert("PM_2 Particles level is Dangerous!");
            break;
        case "Unhealthy":
            alert("PM_2 Particles level is Unhealthy!");
            break;
        case "Moderate":
            alert("PM_2 Particles level is Moderate!");
            break;
    }

    switch (statusElementPM10.textContent) {
        case "Dangerous":
            alert("PM10 Particles level is Dangerous!");
            break;
        case "Unhealthy":
            alert("PM10 Particles level is Unhealthy!");
            break;
        case "Moderate":
            alert("PM10 Particles level is Moderate!");
            break;
    }

    switch (statusElementO3.textContent) {
        case "Dangerous":
            alert("Ozone level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Ozone level is Unhealthy!");
            break;
        case "Moderate":
            alert("Ozone level is Moderate!");
            break;
    }

    switch (statusElementSO2.textContent) {
        case "Dangerous":
            alert("Sulfur Dioxide level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Sulfur Dioxide level is Unhealthy!");
            break;
        case "Moderate":
            alert("Sulfur Dioxide level is Moderate!");
            break;
    }

    switch (statusElementNO.textContent) {
        case "Dangerous":
            alert("Nitrogen Monoxide level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Nitrogen Monoxide level is Unhealthy!");
            break;
        case "Moderate":
            alert("Nitrogen Monoxide level is Moderate!");
            break;
    }

    switch (statusElementNO2.textContent) {
        case "Dangerous":
            alert("Nitrogen Dioxide level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Nitrogen Dioxide level is Unhealthy!");
            break;
        case "Moderate":
            alert("Nitrogen Dioxide level is Moderate!");
            break;
    }

    switch (statusElementCO.textContent) {
        case "Dangerous":
            alert("Carbon Monoxide level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Carbon Monoxide level is Unhealthy!");
            break;
        case "Moderate":
            alert("Carbon Monoxide level is Moderate!");
            break;
    }

    switch (statusElementNH3.textContent) {
        case "Dangerous":
            alert("Ammonia level is Dangerous!");
            break;
        case "Unhealthy":
            alert("Ammonia level is Unhealthy!");
            break;
        case "Moderate":
            alert("Ammonia level is Moderate!");
            break;
    }




}

function updateCharts(airQualityData) {
    const airQualityDataPoints = [
        airQualityData.list[0].components.pm2_5,
        airQualityData.list[0].components.pm10,
        airQualityData.list[0].components.o3,
        airQualityData.list[0].components.co,
        airQualityData.list[0].components.no,
        airQualityData.list[0].components.no2,
        airQualityData.list[0].components.so2,
        airQualityData.list[0].components.nh3
    ];

    const airQualityChart = new Chart(document.getElementById("search").getContext("2d"), {
        type: 'pie',
        data: {
            labels: ["PM2.5", "PM10", "Ozone", "Carbon Monoxide", "Nitrogen Monoxide", "Nitrogen Dioxide",
                "Sulfur Dioxide", "Ammonia"
            ],
            datasets: [{
                label: 'Air Quality Levels',
                data: airQualityDataPoints,
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1

            }]

        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw} µg/m³`;
                        }
                    }
                }
            }
        }


    });
}
