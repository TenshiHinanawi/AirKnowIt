<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherData;
use App\Models\AirQualityData;

class WeatherHistoryController extends Controller
{
    public function showWeatherData(Request $request)
    {
        $location = $request->input('location'); // Default to 'all' if no location is selected

        if ($location != 'all') {
            $weatherData = WeatherData::where('location', $location)->get();
        } else {
            $weatherData = WeatherData::all();
        }

        return view('historical_weather', [
            'weatherData' => $weatherData,
            'location' => $location
        ]);
    }

    public function showAirData(Request $request)
    {
        $location = $request->input('location'); // Default to 'all' if no location is selected

        if ($location != 'all') {
            $AirQualityData = AirQualityData::where('location', $location)->get();
        } else {
            $AirQualityData = AirQualityData::all();
        }

        return view('historical_air', [
            'AirQualityData' => $AirQualityData,
            'location' => $location
        ]);
    }


}
