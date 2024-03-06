@extends('layout')

@section('title')
    forecast
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
                @foreach (\App\Models\City::all() as $city)
                    <div class="row py-4">
                        <div class="card" style="border-radius: 25px;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between">
                                    <div class="title">
                                        <h4 class="text-muted mb-">{{ $city->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                <a type="button" class="btn btn-sm btn-outline-primary"
                                {{-- href="{{ route('cityForecast', ['city' => $forecast->city->name]) }}" --}}
                                >
                                            View details
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center mb-4 pb-3 pt-2">
                                @foreach ($city->forecasts->sortBy('date') as $forecast)
                                    <div class="col">
                                        <p class="small"><strong>{{ $forecast->temperature }} C</strong></p>

                                        <p class="small">
                                            @if ($forecast->weather_type == 'sunny')
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                            @elseif ($forecast->weather_type == 'rainy')
                                                <i class="fas fa-cloud-rain fa-2x mb-3" style="color: #ddd;"></i>
                                            @elseif ($forecast->weather_type == 'snow')
                                                <i class="fa-regular fa-snowflake fa-2x mb-3" style="color: #ddd;"></i>

                                            @else
                                                <i class="fas fa-question-circle fa-2x mb-3" style="color: #ddd;"></i>
                                            @endif
                                        </p>

                                        <p class="mb-0"><strong>{{ strftime('%A, %b %d', strtotime($forecast->date)) }}</strong></p>
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
