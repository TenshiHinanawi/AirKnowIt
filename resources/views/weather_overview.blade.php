<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirKnowIt</title>
    <link rel="stylesheet" href="{{ asset('weather.css') }}">
</head>


<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">
    <div id="container">
        <div class="header">
            <h1>AirKnowIt Dashboard</h1>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                        class="dashboardtext">
                        Dashboard
                    </a>

                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="switch-label"></span>
            </label>
        </div>


        <div class="card">
            <h2>Weather & Air Quality for <span id="search-location">--</span></h2>
            <p><span class="icon" id="weather-icon">--</span> Weather: <span id="weather">--</span></p>
            <p><span class="icon">🌫️</span> Visibility: <span id="search-visibility">--</span> meters</p>
            <p><span class="icon">☁️</span> Cloudiness: <span id="search-cloudiness">--</span>%</p>
        </div>

        <div class="card">
            <h2>Temperature</h2>
            <p><span class="icon">🌡️</span> Temperature: <span id="search-temperature">--</span>°C</p>
            <p><span class="icon">🌡️</span> Feels Like: <span id="search-feels-like">--</span>°C</p>
            <p><span class="icon">📉</span> Min Temperature: <span id="search-temp-min">--</span>°C</p>
            <p><span class="icon">📈</span> Max Temperature: <span id="search-temp-max">--</span>°C</p>
            <p><span class="icon">💧</span> Humidity: <span id="search-humidity">--</span>%</p>
            <p><span class="icon">⚖️</span> Pressure: <span id="search-pressure">--</span> hPa</p>
        </div>
        <div class="card">
            <h2>Air Quality</h2>
            <p><span class="icon">💨</span> PM2.5: <span id="search-pm25"></span> µg/m³ - <span
                    id="search-pm25-status">--</span></p>
            <p><span class="icon">🏭</span> PM10: <span id="search-pm10"></span> µg/m³ - <span
                    id="search-pm10-status">--</span></p>
            <p><span class="icon">🌿</span> Ozone: <span id="search-ozone"></span> µg/m³ - <span
                    id="search-ozone-status">--</span></p>
            <p><span class="icon">🌫️</span> SO2: <span id="search-sulfur"></span> µg/m³ - <span
                    id="search-sulfur-status">--</span></p>
            <p><span class="icon">🚗</span> NO: <span id="search-nitro"></span> µg/m³ - <span
                    id="search-nitro-status">--</span></p>
            <p><span class="icon">🚗</span> NO2: <span id="search-nitrodio"></span> µg/m³ - <span
                    id="search-nitrodio-status">--</span></p>
            <p><span class="icon">⛽</span> CO: <span id="search-carbon"></span> µg/m³ - <span
                    id="search-carbon-status">--</span></p>
            <p><span class="icon">🌱</span> NH3: <span id="search-ammonia"></span> µg/m³ - <span
                    id="search-ammonia-status">--</span></p>
        </div>
        <div class="card">
            <h2>Wind</h2>
            <p><span class="icon">🌬️</span> Wind Speed: <span id="search-wind-speed"></span> m/s</p>
            <p><span class="icon">💨</span> Wind Gust: <span id="search-wind-gust"></span> m/s</p>
            <p><span class="icon">🧭</span> Wind Direction: <span id="search-wind-direction"></span>°</p>
        </div>


        <div class="chart-container">
            <canvas id="geochart-1" width="400" height="400"></canvas>
        </div>
    </div>
    <script src="{{ asset('geolocscript.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</body>

</html>
