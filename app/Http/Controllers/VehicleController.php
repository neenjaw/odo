<?php

namespace App\Http\Controllers;

use App\Models\MilageEntry;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $vehicles = Vehicle::where('owner_id', $user->id)->get();

        return view('welcome', [
            'vehicles' => $vehicles,
        ]);
    }

    public function showVehicle(string $id): RedirectResponse | View
    {
        $vehicle = Vehicle::where('id', $id)->first();

        if (!$vehicle) {
            return redirect()->back();
        }

        $entries = MilageEntry::getForVehicle($vehicle->id);

        return view('vehicle.show', [
            'vehicle' => $vehicle,
            'milageEntries' => $entries,
        ]);
    }
}
