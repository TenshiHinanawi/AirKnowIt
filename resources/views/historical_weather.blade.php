<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('weather.css') }}">
    <title>Weather Data</title>
</head>

@auth

    <body>
        <!-- Theme toggle switch -->
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="switch-label"></span>
        </label>

        <!-- Header Section -->
        <div class="header">
            <h1>AirKnowIt</h1>
            <div class="dropdown">
                <button class="dropdown-btn">Select Location</button>
                <div class="dropdown-content">
                    <a href="{{ route('historical.weather', ['location' => 'Navotas']) }}">Navotas</a>
                    <a href="{{ route('historical.weather', ['location' => 'Manila']) }}">Manila</a>
                    <a href="{{ route('historical.weather', ['location' => 'Cebu City']) }}">Cebu City</a>
                    <a href="{{ route('historical.weather', ['location' => 'London']) }}">London</a>
                    <a href="{{ route('historical.weather', ['location' => 'New York']) }}">New York</a>
                </div>
            </div>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="dashboardtext">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="dashboardtext">Log in (Yo you are not supposed to be here)</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="dashboardtext">Register (Hacker??)</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
        <br>
        <div id="container">
            <div class="card">
                <h2>Temperature</h2>
                <div class="linechart1">
                    <canvas id="temp"></canvas>
                </div>
            </div>

            <!-- Humidity Chart Section -->
            <div class="card">
                <h2>Humidity</h2>
                <div class="linechart1">
                    <canvas id="humidity"></canvas>
                </div>
            </div>

            <!-- Wind Speed Chart Section -->
            <div class="card">
                <h2>Wind Speed</h2>
                <div class="linechart1">
                    <canvas id="wind"></canvas>
                </div>
            </div>

        </div>

        <br>
        <br>
        <script>
            // Prepare data for the charts
            const labels = @json(
                $weatherData->pluck('created_at')->map(function ($date) {
                    return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
                }));

            const temperatures = @json($weatherData->pluck('temperature'));
            const feelsLike = @json($weatherData->pluck('feels_like'));
            const humidity = @json($weatherData->pluck('humidity'));
            const windSpeed = @json($weatherData->pluck('wind_speed'));
            const pressure = @json($weatherData->pluck('pressure'));
            const weather = @json($weatherData->pluck('description'));
            const windDirection = @json($weatherData->pluck('wind_direction'));
            const gust = @json($weatherData->pluck('wind_gust'));
            const locationName = @json($location ?? 'All Locations'); // Get the location name
        </script>
        <script src="{{ asset('weather.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        </div>
    </body>
@endauth

</html>
