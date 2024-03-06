
@extends('layout')

@section('title')
    Add weather
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5 col-10 p-4">
            <h4>Add weather for today</h4>

            <form class="row" method="POST" action="{{route("NewWeather")}}">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

            {{ csrf_field() }}
            <div style="padding: 0;" class="row mt-2 col-12">
                <div class="col col-md-12 col-12 mt-2 mt-md-0">
                <select class="form-select" aria-label="Default select example" name="city_id">
                    @foreach (\App\Models\City::orderByDesc('id')->get() as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
                <div style="padding: 0;" class="row my-2 col-12">
                    <div class="col col-md-12 col-12 mt-2 mt-md-0">
                        <input  name="temperature" value="{{ old("temperature") }}"  required type="number" class="form-control" placeholder="temperature">
                    </div>
                </div>


                <button class="btn btn-outline-primary">Create Weather forecast for today</button>

            </form>
        </div>
    </div>
@endsection

