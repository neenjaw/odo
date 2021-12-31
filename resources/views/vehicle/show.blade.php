@extends('layouts.app', ['title' => 'Vehicle: ' . $vehicle->name])
@section('content')
  <div class="h-screen bg-gray-50 flex flex-col items-center justify-center gap-4">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-row items-center justify-between">
      <span>Logged in as {{ Auth::user()->name }}</span>
      <span><a href="{{ route('logout') }}" class="text-indigo-600 inline-block underline">Logout</a></span>
    </div>

    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-col gap-4">
        @foreach ($milageEntries as $milageEntry)
            <div>
                <ul>
                    <li>{{ $milageEntry->odometer_reading }}</li>
                    <li>{{ $milageEntry->odometer_diff }}</li>
                    <li>{{ $milageEntry->milage }} km / L</li>
                    <li>{{ $milageEntry->fuel_economy }} L / 100km</li>
                </ul>
            </div>
        @endforeach
    </div>
    <div class="w-full max-w-lg flex justify-between items-center">
        <a href="{{ route('index') }}" class="bg-white hover:bg-gray-300 shadow-lg rounded-md p-4">
            Back
        </a>
        <a href="{{ route('milage.form') }}" class="bg-green-300 hover:bg-green-400 shadow-lg rounded-md p-4">
            Add Milage
        </a>
    </div>
  </div>
@endsection
