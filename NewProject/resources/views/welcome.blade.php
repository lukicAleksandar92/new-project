@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center flex-column align-items-center text-center">
                <div class="my-2">
                    <h4>WELCOME TO MOST PRECISE WEATHER FORECAST</h4>
                </div>

                <form action="" class="my-4">
                    <div class="mx-auto">
                        <div class="d-flex justify-content-center">
                            <input id="newsletter1" type="text" class="form-control" name='city'
                                placeholder="Type the name of the city...">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>

                        @foreach ($userFavourites as $favourite)
                            <p>
                                <i class="fa-solid fa-heart text-danger"></i>

                                <i class="fas {{ $favourite->city->icon }}"></i>

                                {{ $favourite->city->name }}

                                {{ $favourite->city->todaysForecast->temperature }} C
                            </p>
                        @endforeach
                    </div>
                </form>

                <div>
                    <a class="btn btn-outline-primary my-2" href="/weather">See Weather For Today</a>
                </div>
                <div>
                    <a class="btn btn-outline-dark my-2" href="/forecast">See Forecasts For Next 5 days</a>
                </div>
            </div>
        </div>
    </div>
@endsection
