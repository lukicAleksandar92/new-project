@extends('layout')

@section('title')
    Weather
@endsection


@section('content')
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <main>
        <section class="py-2 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-8 col-md-8 mx-auto">
                    <h1 class="fw-light">Today's Weather - {{ now()->format('d-m-Y, l') }}</h1>
                    <p class="lead text-body-secondary">Stay informed about the weather. Whether you're planning a trip
                        or just want to stay ahead of the weather, our comprehensive forecasts will keep you informed.
                    </p>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-center w-100 my-4">
                    <div class="mx-auto" style="width: 50%;">
                        <div class="d-flex justify-content-center">

                            <input id="newsletter1" type="text" class="form-control"
                                placeholder="Type the name of the city...">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($allWeathers->sortByDesc('id') as $weather)
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-4 pb-2">
                                        <div>
                                            <h2 class="display-5">
                                                <strong>
                                                    {{ $weather->city->todaysForecast->temperature }}°C
                                                </strong>
                                            </h2>
                                            <h4 class="text-muted mb-">{{ $weather->city->name }}</h4>
                                            <p class="text-muted mb-0">{{ now()->format('d-m-Y, l') }}</p>
                                        </div>
                                        <div>
                                            @php
                                                $icon = \App\Http\ForecastHelper::getIconByType(
                                                    $weather->city->todaysForecast->weather_type,
                                                );
                                            @endphp
                                            <i class="fas {{ $icon }} fa-2x mb-3"></i>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-primary"
                                                href="
                                            {{ route('cityWeather', ['city' => $weather->city->name]) }}
                                            ">
                                                View details</a>
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-dark"
                                                href="{{ route('cityForecast', ['city' => $weather->city->name]) }}">
                                                View forecast
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
@endsection
