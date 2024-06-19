<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
  use HasFactory;

    /**
     *
     * @var array
     */
    protected $fillable = [
			'city',
			'temperature',
			'humidity',
			'wind_speed',
			'description',
			'timestamp',
    ];

    /**
     *
     * @var array
     */
    protected $casts = [
			'timestamp' => 'datetime',
    ];
}
