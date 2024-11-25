<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the 'weather_data' table first
        Schema::create('fetched_weather_data', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('country');
            $table->string('weather');
            $table->string('description');
            $table->float('temperature');
            $table->float('feels_like');
            $table->float('temp_min');
            $table->float('temp_max');
            $table->unsignedTinyInteger('humidity'); // Percentages 0–100
            $table->float('pressure');
            $table->unsignedBigInteger('visibility'); // Large values
            $table->unsignedTinyInteger('cloudiness'); // Percentages 0–100
            $table->float('wind_speed');
            $table->float('wind_gust')->nullable();
            $table->float('wind_direction')->nullable(); // Optional if data is unavailable
            $table->timestamps();
        });

        // Create the 'air_quality_data' table after the 'weather_data' table
        Schema::create('fetched_air_quality_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weather_id')->constrained('fetched_weather_data')->onDelete('cascade');
            $table->string('location');
            $table->string('country');
            $table->float('pm2_5');
            $table->float('pm10');
            $table->float('o3');
            $table->float('so2');
            $table->float('no');
            $table->float('no2');
            $table->float('co');
            $table->float('nh3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fetched_air_quality_data');
        Schema::dropIfExists('fetched_weather_data');
    }
};
