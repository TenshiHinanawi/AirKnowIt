<!DOCTYPE html>
<html lang="en">
@auth
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Air Quality Data</title>
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
            width: 500px;
        }

        .dashboardtext {
            color: rgb(0, 0, 0);
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Air Quality Data for {{ $location ?? 'All Locations' }}</h1>
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                <a href="{{ url('/dashboard') }}" class="dashboardtext">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
    <br>
    @auth
    <!-- Location Selection Form -->
    <form method="GET" action="{{ route('historical.air') }}" id="locationForm">
        <label>
            <input type="radio" name="location" value="Navotas" {{ request('location') == 'Navotas' ? 'checked' : '' }} onchange="this.form.submit()"> Navotas
        </label>
        <label>
            <input type="radio" name="location" value="Manila" {{ request('location') == 'Manila' ? 'checked' : '' }} onchange="this.form.submit()"> Manila
        </label>
        <label>
            <input type="radio" name="location" value="Cebu City" {{ request('location') == 'Cebu City' ? 'checked' : '' }} onchange="this.form.submit()"> Cebu City
        </label>
        <label>
            <input type="radio" name="location" value="London" {{ request('location') == 'London' ? 'checked' : '' }} onchange="this.form.submit()"> London
        </label>
        <label>
            <input type="radio" name="location" value="New York" {{ request('location') == 'New York' ? 'checked' : '' }} onchange="this.form.submit()"> New York
        </label>
        <label>
            <input type="radio" name="location" value="all" {{ request('location') == 'all' ? 'checked' : '' }} onchange="this.form.submit()"> Reveal All Data
        </label>
    </form>



        <!-- Air Quality Line Chart -->
        <div class="linechart1"><canvas id="lineChart"></canvas></div>

        <script>
            // Prepare data for the chart
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

            // Create the line chart
            const ctx = document.getElementById('lineChart').getContext('2d');
            const lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // X-axis labels (timestamps)
                    datasets: [
                        {
                            label: 'PM2.5',
                            data: pm2_5, // Y-axis data for PM2.5
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false, // Do not fill the area under the line
                            tension: 0.1
                        },
                        {
                            label: 'PM10',
                            data: pm10, // Y-axis data for PM10
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false, // Do not fill the area under the line
                            tension: 0.1
                        },
                        {
                            label: 'O3',
                            data: o3, // Y-axis data for Ozone (O3)
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: false, // Do not fill the area under the line
                            tension: 0.1
                        },
                        {
                            label: 'SO2',
                            data: so2, // Y-axis data for Sulfur Dioxide (SO2)
                            borderColor: 'rgb(153, 102, 255)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            fill: false, // Do not fill the area under the line
                            tension: 0.1
                        },
                        {
                            label: 'CO',
                            data: co, // Y-axis data for Carbon Monoxide (CO)
                            borderColor: 'rgb(255, 159, 64)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
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
                            text: `Historical Air Quality of ${locationName}`, // Dynamic title with the location
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
                                text: 'Air Quality (µg/m³ or ppm)'
                            }
                        }
                    }
                }
            });
        </script>
    @endauth
</body>
@endauth
</html>
