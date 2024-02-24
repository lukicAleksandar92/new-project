
@extends('layout')

@section('title')
    Add weather
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5 col-12 p-4">
            <h4>Add weather forecast</h4>

            <form class="row" method="POST" action="{{route("NewWeather")}}">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

            {{ csrf_field() }}

                <div style="padding: 0;" class="row mt-2 col-12">
                    <div class="col col-md-12 col-12 mt-2 mt-md-0">
                        <input  name="city" value="{{ old("city") }}" required type="name" class="form-control" placeholder="city">
                    </div>
                </div>
                <div style="padding: 0;" class="row mt-2 col-12">
                    <div class="col col-md-12 col-12 mt-2 mt-md-0">
                        <input  name="country" value="{{ old("country") }}" required type="text" class="form-control" placeholder="country">
                    </div>
                </div>
                <div style="padding: 0;" class="row mt-2 col-12">
                    <div class="col col-md-12 col-12 mt-2 mt-md-0">
                        <input  name="temperature" value="{{ old("temperature") }}"  required type="number" class="form-control" placeholder="temperature">
                    </div>
                </div>
                <div style="padding: 0;" class="row mb-3 mt-2 col-12">
                    <div class="col col-md-12 col-12 mt-2 mt-md-0">
                        <input type="date" name="date" class="form-control" placeholder="date">
                    </div>
                </div>


                <button class="btn btn-outline-primary">Create New weather forecast</button>

            </form>

        </div>
    </div>
@endsection

