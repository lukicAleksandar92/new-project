<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";

    protected $fillable = [
        'name',
    ];


    public function weathers()
    {
        return $this->hasMany(Weather::class, 'city_id', 'id');
    }



    public function forecasts()
    {
        return $this->hasMany(Forecast::class, 'city_id', 'id');
    }


    public function todaysForecast()
    {

        return $this->hasOne(Forecast::class, "city_id", "id")->whereDate('date', Carbon::now());

    }



}
