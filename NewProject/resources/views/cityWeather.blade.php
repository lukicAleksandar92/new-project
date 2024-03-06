@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">

    <h4>WEATHER CITY</h4>

    <p>Weather for <b> {{ $city->name }} </b> on {{ now()->format('d-m-Y, l') }}</p>


    @foreach ($city->weathers as $weather)
        {{ $weather->temperature}} °C<br><hr>


    @endforeach


</div>



@endsection
