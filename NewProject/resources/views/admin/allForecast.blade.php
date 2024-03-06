
@extends('layout')

@section('title')
    forecast
@endsection


@section('content')



<div class="container">
    <div class="row justify-content-center">

            <div class="col-md-5 col-10 p-4">
                <h4>Forecast - {{ now()->format('F Y') }}</h4>


                <form class="row my-2 justify-content-around" method="POST" action="{{ route('forecast.add') }}">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif

                    {{ csrf_field() }}

                    <div style="padding: 0;" class="row my-2 col-6">
                        <div class="col col-md-12 col-12 mt-2 mt-md-0">
                            <select class="form-select" aria-label="Default select example" name="city_id">
                                @foreach (\App\Models\City::all() as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="padding: 0;" class="row my-2 col-6">
                        <div class="col col-md-12 col-12 mt-2 mt-md-0">
                            <input name="temperature" required type="number"
                                class="form-control" placeholder="temperature">
                        </div>
                    </div>
                    <div style="padding: 0;" class="row my-2 col-6">
                        <div class="col col-md-12 col-12 mt-2 mt-md-0">
                            <select class="form-select" aria-label="Default select example" name="weather_type">
                                @foreach (\App\Models\Forecast::WEATHERS as $oneWeather)
                                    <option value="{{ $oneWeather }}">{{ $oneWeather }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="padding: 0;" class="row my-2 col-6">
                        <div class="col col-md-12 col-12 mt-2 mt-md-0">
                                <input name="probability" type="number" class="form-control" placeholder="Probability">
                        </div>
                    </div>
                    <div style="padding: 0;" class="row my-2 col-12">
                        <div class="col col-md-12 col-12 mt-2 mt-md-0">
                            <input name="date" required type="date"
                                class="form-control" placeholder="date">
                        </div>
                    </div>
                    <button class="btn btn-outline-primary my-2">Add forecast </button>
                </form>
            </div>
        </div>

        @foreach (\App\Models\City::all() as $city)
        <h2>{{ $city->name }}</h2>
            <table class="table text-center border-line">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Temperature</th>
                        <th scope="col">Probabilty</th>
                        <th scope="col">Weather type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($city->forecasts as $forecast)
                        <tr>
                            <td>{{$forecast->date}}</td>
                            <td>{{$forecast->temperature }} C</td>
                            <td>
                                @if ($forecast->probability)
                                    <p>{{$forecast->probability}}%</p>
                                @endif
                            </td>
                            <td>
                                @if ($forecast->weather_type == 'sunny')
                                    <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                @elseif ($forecast->weather_type == 'rainy')
                                    <i class="fas fa-cloud-rain fa-2x mb-3" style="color: #ddd;"></i>
                                @elseif ($forecast->weather_type == 'snow')
                                    <i class="fa-regular fa-snowflake fa-2x mb-3" style="color: #ddd;"></i>
                                @else
                                    <i class="fas fa-question-circle fa-2x mb-3" style="color: #ddd;"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

    </div>

@endsection

