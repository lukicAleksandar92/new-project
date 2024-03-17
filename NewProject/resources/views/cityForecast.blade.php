@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">

    <h4>FORECAST CITY</h4>

    <p>Forecast for <b> {{ $city->name }} </b> in next 5 days</p>

    <p class="small">
        Sunrise :  {{ $sunriseTime }}
    </p>

    <p class="small">
        Sunset : {{ $sunsetTime }}
    </p>

    <div class="row text-center mb-4 pb-3 pt-2">
        @foreach ($city->forecasts->sortBy('date') as $forecast)
            @php
                $color = \App\Http\ForecastHelper::getColorByTemperature(
                    $forecast->temperature,
                );
                $icon = \App\Http\ForecastHelper::getIconByType($forecast->weather_type);
            @endphp
            <div class="col">
                <p class="small"> <span style="color:{{ $color }};">
                        {{ $forecast->temperature }} C
                    </span>
                </p>
                <p class="small">
                    <i class="fas {{ $icon }} fa-2x mb-3"></i>
                </p>
                <p class="mb-0">
                    <strong>{{ strftime('%A, %b %d', strtotime($forecast->date)) }}</strong>
                </p>

            </div>
        @endforeach
    </div>


</div>



@endsection
