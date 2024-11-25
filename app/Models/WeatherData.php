<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'fetched_weather_data';  // Ensure this matches your migration table name

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'location', 'country', 'weather', 'description' ,'temperature', 'feels_like', 'temp_min', 'temp_max',
        'humidity', 'pressure', 'visibility', 'cloudiness', 'wind_speed', 'wind_gust',
        'wind_direction'
    ];
}

