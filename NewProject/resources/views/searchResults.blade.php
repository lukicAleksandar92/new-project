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

                @if(\Illuminate\Support\Facades\Session::has('error'))
                    <p style="color: red">
                        error : {{\Illuminate\Support\Facades\Session::get('error') }}
                    </p>
                    <a class="btn btn-primary" type="button" href="/login">Login</a>
                @endif

                @foreach ($cities as $city)
                    @php
                        // $icon = \App\Http\ForecastHelper::getIconByType($city->todaysForecast->weather_type);

                        $isFavorite = Auth::user()->cityFavourites->contains('city_id', $city->id);
                    @endphp

                    <div class="btn-group my-2 align-items-center text center">
                        <a type="button" class="btn btn-sm btn-outline-primary"
                            href="{{ route('cityForecast', ['city' => $city->name]) }}">
                            {{-- <i class="fas {{ $icon }}"></i> --}}
                            {{ $city->name }}
                        </a>

                        @if ($isFavorite)
                            <a type="button" class="btn btn-sm btn-outline-danger"
                                href="{{ route('city.removeFavourite', ['city' => $city->id]) }}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @else
                            <a type="button" class="btn btn-sm btn-outline-danger"
                                href="{{ route('city.favourite', ['city' => $city->id]) }}">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
