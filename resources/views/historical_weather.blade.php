<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Weather Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        canvas {
            margin-top: 30px;
        }

        .linechart1 {
            width: 500px
        }

        .dashboardtext {
            color: rgb(0, 0, 0);
            text-align: center;
        }
    </style>
</head>
@auth
<body>
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

    <!-- Location Selection Form -->
    <form method="GET" action="{{ route('historical.weather') }}" id="locationForm">
        <label>
            <input type="radio" name="location" value="Navotas"
                {{ request('location') == 'Navotas' ? 'checked' : '' }} onchange="this.form.submit()"> Navotas
        </label>
        <label>
            <input type="radio" name="location" value="Manila" {{ request('location') == 'Manila' ? 'checked' : '' }}
                onchange="this.form.submit()"> Manila
        </label>
        <label>
            <input type="radio" name="location" value="Cebu City"
                {{ request('location') == 'Cebu City' ? 'checked' : '' }} onchange="this.form.submit()"> Cebu City
        </label>
        <label>
            <input type="radio" name="location" value="London" {{ request('location') == 'London' ? 'checked' : '' }}
                onchange="this.form.submit()"> London
        </label>
        <label>
            <input type="radio" name="location" value="New York"
                {{ request('location') == 'New York' ? 'checked' : '' }} onchange="this.form.submit()"> New York
        </label>
        <label>
            <input type="radio" name="location" value="all" {{ request('location') == 'all' ? 'checked' : '' }}
                onchange="this.form.submit()"> Reveal All Data
        </label>
        <!-- Add more locations as needed -->
    </form>

    <!-- Weather Data Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Country</th>
                <th>Temperature (°C)</th>
                <th>Feels Like (°C)</th>
                <th>Temp Min (°C)</th>
                <th>Temp Max (°C)</th>
                <th>Humidity (%)</th>
                <th>Pressure (hPa)</th>
                <th>Visibility (m)</th>
                <th>Cloudiness (%)</th>
                <th>Wind Speed (m/s)</th>
                <th>Wind Gust (m/s)</th>
                <th>Wind Direction (°)</th>
                <th>Recorded At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weatherData as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->location }}</td>
                    <td>{{ $data->country }}</td>
                    <td>{{ $data->temperature }}</td>
                    <td>{{ $data->feels_like }}</td>
                    <td>{{ $data->temp_min }}</td>
                    <td>{{ $data->temp_max }}</td>
                    <td>{{ $data->humidity }}</td>
                    <td>{{ $data->pressure }}</td>
                    <td>{{ $data->visibility }}</td>
                    <td>{{ $data->cloudiness }}</td>
                    <td>{{ $data->wind_speed }}</td>
                    <td>{{ $data->wind_gust ?? 'N/A' }}</td>
                    <td>{{ $data->wind_direction ?? 'N/A' }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="linechart1"><canvas id="lineChart"></canvas></div>


    <script>
        // Prepare data for the chart
        const labels = @json(
            $weatherData->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
            }));
        const temperatures = @json($weatherData->pluck('temperature'));
        const feelsLike = @json($weatherData->pluck('feels_like'));
        const locationName = @json($location ?? 'All Locations'); // Get the location name

        // Create the line chart
        const ctx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // X-axis labels (timestamps)
                datasets: [{
                        label: 'Temperature (°C)',
                        data: temperatures, // Y-axis data for temperature
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false, // Do not fill the area under the line
                        tension: 0.1
                    },
                    {
                        label: 'Feels Like (°C)',
                        data: feelsLike, // Y-axis data for feels-like temperature
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false, // Do not fill the area under the line
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: `Historical Temperature of ${locationName}`, // Dynamic title with the location
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
    </script>
</body>
@endauth
</html>
