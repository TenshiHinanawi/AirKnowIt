<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirKnowIt</title>
    <link rel="stylesheet" href="{{ asset('weather.css') }}">
</head>

<body>

    <!-- Main Content -->
    <div id="container">

        <!-- Search Section -->
        <div class="card">
            <input class="search-bar" type="text" id="city-search" placeholder="Enter City Name">
            <button class="mainblade-btn" id="geolocation-btn">Use Geolocation</button>
            <button class="mainblade-btn" id="search-btn">Search City</button>
        </div>

        <!-- Weather & Air Quality Section -->
        <div class="card">
            <h2>Weather & Air Quality for <span id="search-location">--</span></h2>
            <p><span class="icon" id="weather-icon">--</span> <span id="weather">--</span></p>
            <p><span class="icon">🌫️</span> Visibility: <span id="search-visibility">--</span> meters</p>
            <p><span class="icon">☁️</span> Cloudiness: <span id="search-cloudiness">--</span>%</p>
        </div>

        <!-- Temperature Details -->
        <div class="card">
            <h2>Temperature</h2>
            <p><span class="icon">🌡️</span> Temperature: <span id="search-temperature">--</span>°C</p>
            <p><span class="icon">🌡️</span> Feels Like: <span id="search-feels-like">--</span>°C</p>
            <p><span class="icon">📉</span> Min Temperature: <span id="search-temp-min">--</span>°C</p>
            <p><span class="icon">📈</span> Max Temperature: <span id="search-temp-max">--</span>°C</p>
            <p><span class="icon">💧</span> Humidity: <span id="search-humidity">--</span>%</p>
            <p><span class="icon">⚖️</span> Pressure: <span id="search-pressure">--</span> hPa</p>
        </div>

        <!-- Air Quality Details -->
        <div class="card">
            <h2>Air Quality</h2>
            <div class="tooltip">
                <p><span class="icon">💨 <span class="tooltiptext">Fine particulate matter that is hazardous to
                            health. PM2.5 particles are smaller than 2.5 micrometers.</span></span> PM2.5: <span
                        id="search-pm25"></span> µg/m³ - <span id="search-pm25-status"></span></p>
            </div>
            <br>

            <div class="tooltip">
                <p><span class="icon">🏭 <span class="tooltiptext">Fine particulate matter (PM10) is harmful to human
                            health.</span></span> PM10: <span id="search-pm10"></span> µg/m³ - <span
                        id="search-pm10-status">--</span></p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">🌿 <span class="tooltiptext">Ozone (O3) can irritate the lungs and is harmful in
                            large quantities.</span></span> Ozone: <span id="search-ozone"></span> µg/m³ - <span
                        id="search-ozone-status">--</span></p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">🌫️ <span class="tooltiptext">SO2 is a gas that can contribute to acid rain and
                            respiratory issues.</span></span> SO2: <span id="search-sulfur"></span> µg/m³ - <span
                        id="search-sulfur-status">--</span></p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">🚗 <span class="tooltiptext">NO (Nitric Oxide) contributes to air pollution and
                            respiratory problems.</span></span> NO: <span id="search-nitro"></span> µg/m³ - <span
                        id="search-nitro-status">--</span></p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">🚗 <span class="tooltiptext">NO2 (Nitrogen Dioxide) is a key contributor to smog
                            and respiratory diseases.</span></span> NO2: <span id="search-nitrodio"></span> µg/m³ -
                    <span id="search-nitrodio-status">--</span>
                </p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">⛽ <span class="tooltiptext">CO (Carbon Monoxide) can cause poisoning and other
                            health issues when inhaled in large quantities.</span></span> CO: <span
                        id="search-carbon"></span> µg/m³ - <span id="search-carbon-status">--</span></p>
            </div>
            <br>
            <div class="tooltip">
                <p><span class="icon">🌱 <span class="tooltiptext">NH3 (Ammonia) is harmful to the respiratory system
                            in high concentrations.</span></span> NH3: <span id="search-ammonia"></span> µg/m³ - <span
                        id="search-ammonia-status">--</span></p>
            </div>

        </div>

        <!-- Wind Details -->
        <div class="card">
            <h2>Wind</h2>
            <p><span class="icon">🌬️</span> Wind Speed: <span id="search-wind-speed"></span> m/s</p>
            <p><span class="icon">💨</span> Wind Gust: <span id="search-wind-gust"></span> m/s</p>
            <p><span class="icon">🧭</span> Wind Direction: <span id="search-wind-direction"></span>°</p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('mainscript.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</body>

</html>
