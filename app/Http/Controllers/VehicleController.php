<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function showVehicles(): View
    {
        $user = Auth::user();
        $vehicles = Vehicle::where('owner_id', $user->id)->get();

        return view('welcome', [
            'vehicles' => $vehicles,
        ]);
    }
}
