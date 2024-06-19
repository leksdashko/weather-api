<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Temperature;
use Illuminate\Http\Request;
use App\Http\Resources\TemperatureResource;

class TemperatureController extends Controller
{
  public function getDailyTemperature(Request $request)
	{
		try {
			$day = $request->query('day');
			$date = Carbon::createFromFormat('Y-m-d', $day);
			$temperatures = Temperature::whereDate('timestamp', $date->toDateString())->get();

			return TemperatureResource::collection($temperatures);
		} catch (Exception $e) {
				return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
		}
	}
}
