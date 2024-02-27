<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = "weather";

    protected $fillable = [
        // 'city',
        // 'country',
        'city_id',
        'temperature',
        'date',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
