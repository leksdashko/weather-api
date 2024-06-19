<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemperatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
				'city' => $this->city,
				'temperature' => $this->temperature,
				'humidity' => $this->humidity,
				'wind_speed' => $this->wind_speed,
				'description' => $this->description,
				'timestamp' => $this->timestamp->toDateTimeString(),
			];
    }
}
