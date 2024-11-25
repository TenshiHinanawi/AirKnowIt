<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherData;
use App\Models\AirQualityData;

class FetchWeatherData extends Command
{
    protected $signature = 'fetch:data';
    protected $description = 'Fetch weather and air quality data and save to the database';

    public function handle()
    {
        $cities = ["London", "New York", "Tokyo", "Navotas", "Berlin", "Manila", "Cebu", "Quezon"];
        $API_KEY = '49e2122f5c9da4368f1cd972696db508';

        foreach ($cities as $city) {
            // Fetch weather data
            $weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$API_KEY}&units=metric";
            $response = Http::get($weatherUrl);

            if ($response->successful()) {
                $data = $response->json();

                // Save weather data
                $weather = WeatherData::create([
                    'location' => $data['name'],
                    'country' => $data['sys']['country'],
                    'weather' => $data['weather'][0]['main'],
                    'description' => $data['weather'][0]['description'],
                    'temperature' => $data['main']['temp'],
                    'feels_like' => $data['main']['feels_like'],
                    'temp_min' => $data['main']['temp_min'],
                    'temp_max' => $data['main']['temp_max'],
                    'humidity' => $data['main']['humidity'],
                    'pressure' => $data['main']['pressure'],
                    'visibility' => $data['visibility'],
                    'cloudiness' => $data['clouds']['all'],
                    'wind_speed' => $data['wind']['speed'],
                    'wind_gust' => $data['wind']['gust'] ?? null,
                    'wind_direction' => $data['wind']['deg'],
                ]);

                // Fetch air quality data
                $lat = $data['coord']['lat'];
                $lon = $data['coord']['lon'];
                $airQualityUrl = "https://api.openweathermap.org/data/2.5/air_pollution?lat={$lat}&lon={$lon}&appid={$API_KEY}";
                $airQualityResponse = Http::get($airQualityUrl);

                if ($airQualityResponse->successful()) {
                    $airQualityData = $airQualityResponse->json();
                    AirQualityData::create([
                        'weather_id' => $weather->id,
                        'location' => $data['name'],
                        'country' => $data['sys']['country'],
                        'pm2_5' => $airQualityData['list'][0]['components']['pm2_5'],
                        'pm10' => $airQualityData['list'][0]['components']['pm10'],
                        'o3' => $airQualityData['list'][0]['components']['o3'],
                        'so2' => $airQualityData['list'][0]['components']['so2'],
                        'no' => $airQualityData['list'][0]['components']['no'],
                        'no2' => $airQualityData['list'][0]['components']['no2'],
                        'co' => $airQualityData['list'][0]['components']['co'],
                        'nh3' => $airQualityData['list'][0]['components']['nh3'],
                    ]);
                    $this->info("Air quality data for {$city} saved successfully.");
                } else {
                    $this->error("Failed to fetch air quality data for {$city}");
                }

                $this->info("Weather data for {$city} saved successfully.");
            } else {
                $this->error("Failed to fetch weather data for {$city}");
            }
        }
    }
}
