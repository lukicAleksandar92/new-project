<?php

namespace App\Http;

class ForecastHelper
{
    const WEATHER_ICONS = [
        'sunny' => 'fa-sun text-warning',
        'rainy' =>'fa-cloud-rain text-secondary',
        'snow' => 'fa-snowflake text-info',
        'cloudy' => 'fa-cloud text-muted',
    ];


    public static function getIconByType($type) {

        // if(in_array($type, self::WEATHER_ICONS)) {

        //     return self::WEATHER_ICONS[$type];

        // }

        // return 'fa-sun text-warning';

        $icon = match($type) {
            'sunny' => 'fa-sun text-warning',
            'rainy' =>'fa-cloud-rain text-secondary',
            'snow' => 'fa-snowflake text-info',
            'cloudy' => 'fa-cloud text-muted',
            default => 'fa-sun'
        };

        return $icon;

    }


    public static function getColorByTemperature($temperature) {

        if($temperature <=0) {
            $color = "lightblue";
        }
        elseif ($temperature >0 && $temperature<=15) {
            $color = "blue";
        }
        elseif ($temperature >15 && $temperature<=25) {
            $color = "green";
        } else {
            $color = "red";
        };

        return $color;

    }






}


?>
