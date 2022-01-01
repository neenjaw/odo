@extends('layouts.app', ['title' => 'Vehicle: ' . $vehicle->name])
@section('content')
  <div class="h-screen bg-gray-50 flex flex-col items-center justify-center gap-4">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-row items-center justify-between">
      <span>Logged in as {{ Auth::user()->name }}</span>
      <span><a href="{{ route('logout') }}" class="text-indigo-600 inline-block underline">Logout</a></span>
    </div>

    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-row gap-4 items-center">
        <img src="{{ asset('/img/icons/car.svg') }}" alt="vehicle" class="w-14 h-14" />
        <h1 class="font-bold text-2xl">{{ $vehicle->name }}</h1>
    </div>

    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-4 flex flex-col gap-4">
        <p>Milage Entries</p>
        @foreach ($milageEntries as $milageEntry)
            @include('milage_entry.entry')
        @endforeach
    </div>
    <div class="w-full max-w-lg flex justify-between items-center">
        <a href="{{ route('index') }}" class="transition-colors bg-white hover:bg-gray-300 shadow-lg rounded-md p-4">
            Back
        </a>
        <a href="{{ route('milage.form') }}" class="transition-colors bg-green-100 hover:bg-green-200 shadow-lg rounded-md p-4">
            Add Milage
        </a>
    </div>
  </div>
@endsection
