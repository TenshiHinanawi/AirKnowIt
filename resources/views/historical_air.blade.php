<!DOCTYPE html>
<html lang="en">
@auth

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="{{ asset('weather.css') }}">
        <title>Air Quality Data</title>
    </head>

    <body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">
        <div class="container">
            <h1>Air Quality Data for {{ $location ?? 'All Locations' }}</h1>
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


            <div class="form-container">
                <!-- Location Dropdown -->
                <div class="dropdown">
                    <button class="dropdown-btn">Select Location</button>
                    <div class="dropdown-content">
                        <a href="{{ route('historical.air', ['location' => 'Navotas']) }}">Navotas</a>
                        <a href="{{ route('historical.air', ['location' => 'Manila']) }}">Manila</a>
                        <a href="{{ route('historical.air', ['location' => 'Cebu City']) }}">Cebu City</a>
                        <a href="{{ route('historical.air', ['location' => 'London']) }}">London</a>
                        <a href="{{ route('historical.air', ['location' => 'New York']) }}">New York</a>
                        <a href="{{ route('historical.air', ['location' => 'all']) }}">Reveal All Data</a>
                    </div>
                </div>
            </div>
            <br>
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

            <script>
                // Prepare data for the line chart
                const labels = @json(
                    $AirQualityData->pluck('created_at')->map(function ($date) {
                        return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
                    }));

                const pm2_5 = @json($AirQualityData->pluck('pm2_5'));
                const pm10 = @json($AirQualityData->pluck('pm10'));
                const o3 = @json($AirQualityData->pluck('o3'));
                const so2 = @json($AirQualityData->pluck('so2'));
                const co = @json($AirQualityData->pluck('co'));

                const locationName = @json($location ?? 'All Locations'); // Get the location name
            </script>
            <script src="{{ asset('airquality.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        </div>
    </body>
@endauth

</html>
