window.onload = function() {
    document.getElementById("geolocation-btn").addEventListener("click", () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                await fetchWeatherData(null, lat, lon);
            }, () => alert("Geolocation access denied."));
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });

    document.getElementById("search-btn").addEventListener("click", async () => {
        const city = document.getElementById("city-search").value;
        if (city) {
            await fetchWeatherData(city);
        } else {
            alert("Yo bro, real talk, just hit me with that city name, fam. Bro, really out here tryna play like we ain't on the GTA 6 grindset, no cap. Enter that city, or we just gonna be stuck in the opium haze like Huggy Wuggy at the pizza tower subway surfers, for real. DJ Khaled approves, bruh");
        }
    });

    async function fetchWeatherData(city = null, lat = null, lon = null) {
        const API_KEY = '49e2122f5c9da4368f1cd972696db508';
        let weatherUrl;

        if (city) {
            weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric`;
        } else if (lat && lon) {
            weatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${API_KEY}&units=metric`;
        } else {
            alert("Please enter a city or enable geolocation.");
            return;
        }

        try {
            const weatherResponse = await fetch(weatherUrl);
            const weatherData = await weatherResponse.json();
            const airQualityResponse = await fetch(
                `https://api.openweathermap.org/data/2.5/air_pollution?lat=${weatherData.coord.lat}&lon=${weatherData.coord.lon}&appid=${API_KEY}`
            );
            const airQualityData = await airQualityResponse.json();

            updateWeatherInfo(weatherData);
            updateAirQualityInfo(airQualityData);
        } catch (error) {
            alert("Never Gonna Give you up, Never Gonna gonna let you down, Never gonna run around and Hurt you");
            alert("You have been Rickrolled by Sparkle Again");
        }
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

        if (data.weather && data.weather[0]) {
            document.getElementById('weather').textContent = data.weather[0].description;
            const weatherConditionCode = data.weather[0].icon;
            const iconUrl = `https://openweathermap.org/img/wn/${weatherConditionCode}@2x.png`;
            document.getElementById('weather-icon').innerHTML = `<img src="${iconUrl}" alt="${data.weather[0].description}" />`;
        }
    }

    function updateAirQualityInfo(data) {

        const pm25 = data.list[0].components.pm2_5;
        const pm10 = data.list[0].components.pm10;
        const ozone = data.list[0].components.o3;
        const sulfur = data.list[0].components.so2;
        const nitro = data.list[0].components.no;
        const nitrodio = data.list[0].components.no2;
        const carbon = data.list[0].components.co;
        const ammonia = data.list[0].components.nh3;

        document.getElementById("search-pm25").textContent = `${pm25}`;
        document.getElementById("search-pm25-status").textContent = pm25 > 75 ? "Dangerous" : pm25 > 50 ? "Unhealthy" : pm25 > 25 ? "Moderate" : pm25 > 10 ? "Fair" : "Good";
        document.getElementById("search-pm10").textContent = `${pm10}`;
        document.getElementById("search-pm10-status").textContent = pm10 > 200 ? "Dangerous" : pm10 > 100 ? "Unhealthy" : pm10 > 50 ? "Moderate" : pm10 > 20 ? "Fair" : "Good";
        document.getElementById("search-ozone").textContent = `${ozone}`;
        document.getElementById("search-ozone-status").textContent = ozone > 180 ? "Dangerous" : ozone > 140 ? "Unhealthy" : ozone > 100 ? "Moderate" : ozone > 60 ? "Fair" : "Good";
        document.getElementById("search-sulfur").textContent = `${sulfur}`;
        document.getElementById("search-sulfur-status").textContent = sulfur > 350 ? "Dangerous" : sulfur > 250 ? "Unhealthy" : sulfur > 80 ? "Moderate" : sulfur > 20 ? "Fair" : "Good";
        document.getElementById("search-nitro").textContent = `${nitro}`;
        document.getElementById("search-nitro-status").textContent = nitro > 150 ? "Dangerous" : nitro > 100 ? "Unhealthy" : nitro > 50 ? "Moderate" : nitro > 25 ? "Fair" : "Good";
        document.getElementById("search-nitrodio").textContent = `${nitrodio}`;
        document.getElementById("search-nitrodio-status").textContent = nitrodio > 200 ? "Dangerous" : nitrodio > 150 ? "Unhealthy" : nitrodio > 70 ? "Moderate" : nitrodio > 40 ? "Fair" : "Good";
        document.getElementById("search-carbon").textContent = `${carbon}`;
        document.getElementById("search-carbon-status").textContent = carbon > 15400 ? "Dangerous" : carbon > 12400 ? "Unhealthy" : carbon > 9400 ? "Moderate" : carbon > 4400 ? "Fair" : "Good";
        document.getElementById("search-ammonia").textContent = `${ammonia}`;
        document.getElementById("search-ammonia-status").textContent = ammonia > 300 ? "Dangerous" : ammonia > 150 ? "Unhealthy" : ammonia > 50 ? "Moderate" : ammonia > 25 ? "Fair" : "Good";
    }
}
