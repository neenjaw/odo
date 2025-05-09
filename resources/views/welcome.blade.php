@extends('layouts.app', ['title' => 'Home'])
@section('content')
  <div class="h-screen bg-gray-50 flex flex-col items-center justify-center gap-4">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-row items-center justify-between">
      <span>Logged in as {{ Auth::user()->name }}</span>
      <span><a href="{{ route('logout') }}" class="text-indigo-600 inline-block underline">Logout</a></span>
    </div>

    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-col gap-4">
        @foreach ($vehicles as $vehicle)
            <button
            class="transition-colors w-full p-2 pl-4 rounded-md border border-gray-400 flex items-center hover:bg-sky-100"c
            onclick="window.location='{{ route('vehicle.show', ['id' => $vehicle->id]) }}'">
                <div class="w-10 h-10 flex items-center justify-center rounded-3xl bg-gray-700 text-white">
                    {{ strtoupper(substr($vehicle->name, 0, 1)) }}
                </div>
                <div class="p-1 pl-2 flex flex-col text-left">
                    <span>{{ $vehicle->name }}</span>
                    <span>{{ 'milage' }}</span>
                </div>
          </button>
        @endforeach
    </div>

    <a href="{{ route('vehicle.form') }}" class="w-full max-w-lg bg-green-100 hover:bg-green-200 shadow-lg rounded-md p-4 text-center">
        Add a Vehicle
    </a>
  </div>
@endsection
