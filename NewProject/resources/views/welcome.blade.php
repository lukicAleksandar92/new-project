@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">
    <h4>HOME</h4>


    <h4>WELCOME TO MOST PRECISE WEATHER FORECAST</h4>

    <p>

        <a class="btn btn-outline-primary" href="/weather">See Weather For Today</a>
        <a class="btn btn-outline-dark" href="/forecast">See Forecasts For Next 5 days</a>

    </p>


</div>



@endsection
