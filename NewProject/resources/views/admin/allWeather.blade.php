@extends('layout')

@section('title')
    Admin-All weathers
@endsection

@section('content')

<div class="container">
    <h4>All weather forecasts (from newest to oldest)</h4>
    <a class="btn btn-primary centered" href="{{route('admin.addWeather')}}">Add weather forecast</a>
<table class="table text-center">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">City</th>
        <th scope="col">Country</th>
        <th scope="col">Temperature</th>
        <th scope="col">Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($allWeathers as $weather)
        <tr>
            <th scope="row">{{ $weather->id }}</th>
            <td>{{ $weather->city }}</td>
            <td>{{ $weather->country }}</td>
            <td>{{ $weather->temperature }}</td>
            <td>{{ $weather->date }}</td>
            <td>
                <a href="{{route("deleteWeather", ['weather' => $weather->id])}}" class="btn btn-danger centered" onclick="return confirm('Are you sure you want to delete this item?');">Obrisi</a>

                <a href="{{ route('editWeather', ['weather' => $weather->id]) }}" class="btn btn-primary centered">Edituj</a>

            </td>

        </tr>
        @endforeach
    </tbody>
  </table>
</div>

@endsection
