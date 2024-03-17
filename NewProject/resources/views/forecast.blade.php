@extends('layout')

@section('title')
    Forecast
@endsection

@section('content')
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <main>
        <section class="py-2 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-8 col-md-8 mx-auto">
                    <h1 class="fw-light">Forecast - year {{ now()->format('Y') }}</h1>
                    <p class="lead text-body-secondary">Stay informed about the forecast. Whether you're planning a trip or
                        just want to stay ahead of the weather, our comprehensive forecasts will keep you informed.</p>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-center w-100 my-4">
                    <div class="mx-auto" style="width: 50%;">
                        <form method="GET" action="{{ route('forecast.search') }}">
                            <div class="d-flex justify-content-center">
                                <input id="newsletter1" type="text" class="form-control" name='city'
                                    placeholder="Type the name of the city...">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                            @if (\Illuminate\Support\Facades\Session::has('error'))
                                <p style="color: red">Error: {{ \Illuminate\Support\Facades\Session::get('error') }}</p>
                            @endif
                        </form>
                        <div class="row my-4">
                            <h5>Your liked cities:</h5>
                            @foreach ($userFavourites as $favourite)
                                @php
                                    $icon = \App\Http\ForecastHelper::getIconByType(
                                        $favourite->city->todaysForecast->weather_type,
                                    );
                                @endphp
                                <p>
                                    <i class="fa-solid fa-heart text-danger"></i>

                                    <i class="fas {{ $favourite->city->icon }}"></i>

                                    {{ $favourite->city->name }} ->


                                    <i class="fas {{ $icon }}"></i>


                                    {{ $favourite->city->todaysForecast->temperature }} C

                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                @foreach (\App\Models\City::orderBy('id', 'desc')->get() as $city)
                    <div class="row py-4">
                        <div class="card" style="border-radius: 25px;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between">
                                    <div class="title">
                                        <h4 class="text-muted mb-">{{ $city->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-sm btn-outline-primary"
                                            href="{{ route('cityForecast', ['city' => $city->name]) }}">
                                            View details
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center mb-4 pb-3 pt-2">
                                    @foreach ($city->forecasts as $forecast)
                                        @php
                                            $color = \App\Http\ForecastHelper::getColorByTemperature(
                                                $forecast->temperature,
                                            );
                                            $icon = \App\Http\ForecastHelper::getIconByType($forecast->weather_type);
                                        @endphp
                                        <div class="col">
                                            <p class="small">
                                                <span style="color:{{ $color }}">{{ $forecast->temperature }}
                                                    C</span>
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
@endsection
