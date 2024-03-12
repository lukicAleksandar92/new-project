@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">

    <h4>WEATHER CITY</h4>

    <p>Weather for <b> {{ $citiesForecastToday->name }} </b> on {{ now()->format('d-m-Y, l') }}</p>


    @foreach ($citiesForecastToday->weathers as $weather)
        {{ $weather->city->todaysForecast->temperature}} °C<br><hr>
    @endforeach


</div>



@endsection
