<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchTemperature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:temperature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch temperature for the city and save it to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = env('CITY');
        $apiKey = env('OPENWEATHER_API_KEY');
        
        // get the coordinates by city
        $geoResponse = Http::get("http://api.openweathermap.org/geo/1.0/direct?q={$city}&limit=5&appid={$apiKey}");
        
        if ($geoResponse->successful() && count($geoResponse->json()) > 0) {
            $geoData = $geoResponse->json()[0];
            $lat = $geoData['lat'];
            $lon = $geoData['lon'];

            // get the weather by coordinates of the city
            $weatherResponse = Http::get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric");

            if ($weatherResponse->successful()) {
							$weatherData = $weatherResponse->json();
							$temperature = $weatherData['main']['temp'];
							$humidity = $weatherData['main']['humidity'];
							$windSpeed = $weatherData['wind']['speed'];
							$description = $weatherData['weather'][0]['description'];

							Temperature::create([
									'city' => $city,
									'temperature' => $temperature,
									'humidity' => $humidity,
									'wind_speed' => $windSpeed,
									'description' => $description,
									'timestamp' => now(),
							]);

							$this->info('Temperature data fetched and saved.');
					} else {
							$this->error('Failed to fetch weather data.');
					}
        } else {
            $this->error('Failed to fetch geo data.');
        }
    }
}
