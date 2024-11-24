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

    <body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">
        <div class="container">
            <h1>Weather Data for {{ $location ?? 'All Locations' }}</h1>

            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="dashboardtext">
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
            <br>
            <!-- Location Dropdown -->
            <div class="dropdown">
                <button class="dropdown-btn">Select Location</button>
                <div class="dropdown-content">
                    <a href="{{ route('historical.weather', ['location' => 'Navotas']) }}">Navotas</a>
                    <a href="{{ route('historical.weather', ['location' => 'Manila']) }}">Manila</a>
                    <a href="{{ route('historical.weather', ['location' => 'Cebu City']) }}">Cebu City</a>
                    <a href="{{ route('historical.weather', ['location' => 'London']) }}">London</a>
                    <a href="{{ route('historical.weather', ['location' => 'New York']) }}">New York</a>
                    <a href="{{ route('historical.weather', ['location' => 'all']) }}">Reveal All Data</a>
                </div>
            </div>
            <br><br>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="switch-label"></span>
            </label>

            <div class="linechart1">
                <canvas id="lineChart"></canvas>
            </div>

            <div class="barchart1">
                <canvas id="barChart"></canvas>
            </div>


            <div class="doughnutchart1">
                <canvas id="doughnutChart"></canvas>
            </div>

            <div class="radarchart1">
                <canvas id="radarChart"></canvas>
            </div>


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
                const locationName = @json($location ?? 'All Locations'); // Get the location name
            </script>
            <script src="{{ asset('weather.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        </div>
    </body>
@endauth

</html>
