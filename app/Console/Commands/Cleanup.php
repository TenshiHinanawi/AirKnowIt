<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeatherData;

class Cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test cleanup for weather data older than 3 hours.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Log cleanup process start
        $this->info('Starting cleanup for weather data older than 3 hours.');

        // Delete weather data older than 3 hours using 'created_at' field (or 'recorded_at' if you changed it)
        $deletedWeatherData = WeatherData::where('created_at', '<', now()->subHours(3))->delete();

        // Log the number of weather records deleted
        if ($deletedWeatherData) {
            $this->info("Deleted $deletedWeatherData weather records.");
        } else {
            $this->info('No weather records older than 3 hours found for deletion.');
        }

        // Log cleanup completion
        $this->info('Cleanup process completed.');
    }
}
