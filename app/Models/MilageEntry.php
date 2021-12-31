<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilageEntry extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['odometer_reading', 'vehicle_id', 'fuel_volume', 'fuel_cost'];
    protected $guarded = ['vehicle_id'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
