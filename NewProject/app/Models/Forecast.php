<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    protected $table = "forecasts";

    protected $fillable = [
        'city_id',
        'temperature',
        'date',
        'weather_type',
        'probability',
    ];

    const WEATHERS = ['rainy', 'sunny', 'snow'];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id', 'weather_type', 'probability');
        // return $this->belongsTo(City::class);
    }

}
