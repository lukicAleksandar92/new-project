<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCities extends Model
{
    protected $table = "user_cities";

    protected $fillable = [
        'user_id',
        'city_id',
    ];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id' );
        // return $this->belongsTo(City::class, 'city_id');
    }

}
