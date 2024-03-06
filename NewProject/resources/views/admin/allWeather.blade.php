@extends('layout')

@section('title')
    Admin-All weathers
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-5 col-10 p-4">
                <h4>Weather - {{ now()->format('d-m-Y, l') }}</h4>
                <form class="row my-2" method="POST" action="{{ route('weather.update') }}">
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
                            <input name="temperature" value="{{ old('temperature') }}" required type="number"
                                class="form-control" placeholder="temperature">
                        </div>
                    </div>
                    <button class="btn btn-outline-primary">Update weather </button>
                </form>
            </div>
        </div>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">City</th>
                    {{-- <th scope="col">Country</th> --}}
                    <th scope="col">Temperature C</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($allWeathers as $weather)
                    <tr>
                        <td>{{ $weather->city->name }}</td>
                        <td>{{ $weather->temperature }}</td>
                        {{-- <td>
                            <a href="{{ route('deleteWeather', ['weather' => $weather->id]) }}"
                                class="btn btn-danger centered"
                                onclick="return confirm('Are you sure you want to delete this item?');">Obrisi</a>

                            <a href="{{ route('editWeather', ['weather' => $weather->id]) }}"
                                class="btn btn-primary centered">Edituj</a>

                        </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
