<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;
use Carbon\Carbon;

class TemperatureController extends Controller
{
  public function getDailyTemperature(Request $request)
	{
		$day = $request->query('day');
		$date = Carbon::createFromFormat('Y-m-d', $day);
		$temperatures = Temperature::whereDate('timestamp', $date->toDateString())->get();

		return response()->json($temperatures);
	}
}
