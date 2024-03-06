<?php

namespace App\Http;

class ForecastHelper
{
    const WEATHER_ICONS = [
        'sunny' => 'fa-sun text-warning',
        'rainy' =>'fa-cloud-rain text-secondary',
        'snow' => 'fa-snowflake text-info',
    ];


    public static function getIconByType($type) {

        $icons = self::WEATHER_ICONS[$type];
        return $icons;

        // if($type == 'sunny') {

        //     $icon = "fa-sun text-warning";
        // }
        // elseif ($type =='rainy') {
        //     $icon = "fa-cloud-rain text-secondary";
        // }
        // else {
        //     $icon = "fa-snowflake text-info";
        // } ;

        // return $icon;

    }


    public static function getColorByTemperature($temperature) {

        if($temperature <=0) {
            $color = "lightblue";
        }
        elseif ($temperature >=1 && $temperature<=15) {
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
