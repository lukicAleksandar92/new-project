<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = "weather";

    protected $fillable = [
        'city_id',
        'temperature',
    ];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
        // return $this->belongsTo(City::class);
    }


}
