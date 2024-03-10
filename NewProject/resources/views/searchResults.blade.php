@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center flex-column align-items-center text-center">
                <div class="my-2">
                    <h4>Search results...</h4>
                    <hr>
                </div>

                @foreach ($cities as $city)

                    @php
                        $icon = \App\Http\ForecastHelper::getIconByType($city->todaysForecast->weather_type);
                    @endphp


                    <div class="btn-group my-2">
                        <a type="button" class="btn btn-sm btn-outline-primary"
                            href="{{ route('cityForecast', ['city' => $city->name]) }}">
                            <i class="fas {{ $icon }} fa-2x mb-3"></i>
                            {{ $city->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
