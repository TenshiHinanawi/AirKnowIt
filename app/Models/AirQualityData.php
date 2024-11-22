<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirQualityData extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'fetched_air_quality_data';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'weather_id','location', 'country', 'pm2_5', 'pm10', 'o3', 'so2', 'no', 'no2', 'co', 'nh3'
    ];

    // Define the relationship with WeatherData
    public function weatherData()
    {
        return $this->belongsTo(WeatherData::class, 'weather_id');
    }
}
