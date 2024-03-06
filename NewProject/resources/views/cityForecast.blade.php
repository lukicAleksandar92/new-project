@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">

    <h4>FORECAST CITY</h4>

    <p>Forecast for <b> {{ $city->name }} </b> in next 5 days</p>


    @foreach ($city->forecasts as $forecast)
        {{ $forecast->date }}<br>
        {{ $forecast->temperature}} °C<br><hr>


    @endforeach


</div>



@endsection
