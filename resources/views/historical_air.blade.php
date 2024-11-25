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
            <h1>Historical Air Quality Data of {{ $location ?? 'All Locations' }}</h1>
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

            <div class="cont">
                <div class="form-container">
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
            </div>
            <br>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="switch-label"></span>
            </label>
            <br>
            <div class="aircont">
                <h1>Particulate Matter</h1>
                <div class="linechart1">
                    <p style="text-align: justify">PM 2.5 and PM 10 (Particulate Matter) refer to airborne particles with
                        diameters of 2.5 micrometers and 10 micrometers or smaller, respectively. These particles are small
                        enough to be inhaled and can penetrate deep into the lungs, causing respiratory and cardiovascular
                        issues. PM 2.5, being finer, can reach deeper into the lungs and even enter the bloodstream, while
                        PM 10 is generally trapped in the upper respiratory system but can still cause irritation and health
                        problems. Both types of particulate matter are primarily produced by vehicle emissions, industrial
                        processes, and the burning of fossil fuels. Long-term exposure to elevated levels of PM 2.5 and PM
                        10 is linked to an increased risk of lung disease, heart disease, and stroke.</p>
                </div>
                <br>
                <div class="linechart1">
                    <p>PM 2.5</p>
                    <p>Unhealthy Levels: 35+ µg/m³</p>
                    <canvas id="pm2_5"></canvas>
                </div>
                <br>
                <br>
                <br>
                <div class="linechart1">
                    <p>PM 10</p>
                    <p>Unhealthy Levels: 100+ µg/m³</p>
                    <canvas id="pm10"></canvas>
                </div>
            </div>
            <br>
            <div class="aircont">
                <h1>Ozone</h1>
                <div class="linechart1">
                    <p style="text-align: justify">Ozone (O₃) is created at ground level through a chemical reaction between
                        nitrogen oxides (NO) and volatile organic compounds (VOCs) in the presence of sunlight. This
                        process,
                        known as photochemical smog, leads to the formation of harmful ozone, especially in urban areas.
                        Ground-level ozone can cause
                        respiratory issues, worsen asthma, and damage lung tissue. It also harms plants and exacerbates
                        existing
                        health conditions, making it a significant environmental and public health concern.
                    </p>
                </div>
                <br>
                <div class="linechart1">
                    <p>Ozone</p>
                    <p>Unhealthy Levels: 150+ µg/m³</p>
                    <canvas id="ozone"></canvas>
                </div>
            </div>
            <br>
            <div class="aircont">
                <h1>Nitrogen Oxides</h1>
                <div class="linechart1">
                    <p style="text-align: justify">Nitrogen compounds, like nitrogen dioxide (NO₂) and nitric oxide (NO),
                        are
                        harmful air pollutants primarily produced by vehicle emissions and industrial activities. At ground
                        level, they can irritate the respiratory system, exacerbate asthma, and contribute to the formation
                        of
                        smog and acid rain, which can damage ecosystems and human health.</p>
                </div>
                <br>
                <div class="linechart1">
                    <p>Nitrogen Monoxide</p>
                    <p>Unhealthy Levels: 150+ µg/m³</p>
                    <canvas id="nitro-mono"></canvas>
                </div>
                <br>
                <div class="linechart1">
                    <p>Nitrogen Dioxide</p>
                    <p>Unhealthy Levels: 160+ µg/m³</p>
                    <canvas id="nitro-dio"></canvas>
                </div>
            </div>
            <br>
            <div class="aircont">
                <h1>Carbon Monoxide</h1>
                <div class="linechart1">
                    <p style="text-align: justify">Carbon monoxide (CO) is a colorless, odorless gas produced by the
                        incomplete combustion of fossil fuels. It can interfere with the body's ability to transport oxygen,
                        leading to symptoms like dizziness, confusion, and in severe cases, death. High CO levels are
                        particularly dangerous in enclosed spaces and contribute to air pollution.</p>
                </div>
                <br>
                <div class="linechart1">
                    <p>Carbon Monoxide</p>
                    <p>Unhealthy Levels: 1200+ µg/m³</p>
                    <canvas id="carbon"></canvas>
                </div>
            </div>
            <br>
            <div class="aircont">
                <h1>Sulfur Dioxide</h1>
                <div class="linechart1">
                    <p style="text-align: justify">Sulfur dioxide (SO₂) is a colorless gas with a pungent odor, primarily
                        produced by the burning of fossil fuels containing sulfur, such as coal and oil. It can irritate the
                        respiratory system, leading to coughing, shortness of breath, and exacerbating asthma or other lung
                        diseases. Prolonged exposure to high concentrations of sulfur dioxide can cause serious respiratory
                        damage and contribute to the formation of acid rain, which harms ecosystems and buildings.</p>
                </div>
                <br>
                <div class="linechart1">
                    <p>Sulfur Dioxide</p>
                    <p>Unhealthy Levels: 200+ µg/m³</p>
                    <canvas id="sulfur"></canvas>
                </div>
            </div>
            <br>
            <div class="aircont">
                <h1>Ammonia</h1>
                <div class="linechart1">
                    <p style="text-align: justify">Ammonia (NH₃) is a colorless gas with a pungent odor, primarily released
                        from agricultural activities, waste treatment plants, and industrial processes. While essential for
                        plant growth, excessive ammonia levels in the air can irritate the respiratory system, cause
                        coughing, and worsen asthma. In high concentrations, it can damage lung tissue and contribute to the
                        formation of fine particulate matter, making it a significant air quality concern.</p>
                </div>
                <br>
                <div class="linechart1">
                    <p>Ammonia</p>
                    <p>Unhealthy Levels: 150+ µg/m³</p>
                    <canvas id="ammonia"></canvas>
                </div>
            </div>
            <br>
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
                const no = @json($AirQualityData->pluck('no'));
                const no2 = @json($AirQualityData->pluck('no2'));
                const nh3 = @json($AirQualityData->pluck('nh3'));

                const locationName = @json($location ?? 'All Locations'); // Get the location name
            </script>
            <script src="{{ asset('airquality.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        </div>
    </body>
@endauth

</html>
