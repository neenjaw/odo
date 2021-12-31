<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use stdClass;

class MilageEntry extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['odometer_reading', 'vehicle_id', 'fuel_volume', 'fuel_cost'];
    protected $guarded = ['vehicle_id'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function getForVehicle(string $vehicle_id): array
    {
        $entries = MilageEntry::where('vehicle_id', $vehicle_id)
            ->orderByDesc('created_at')
            ->get();

        return $entries->zip($entries->skip(1))
            ->map(function (Collection $zipped) {
                $entry = $zipped->get(0);
                $previousEntry = $zipped->get(1);

                $dto = new stdClass;
                $dto->odometer_reading = $entry->odometer_reading;
                $dto->odometer_diff = self::getOdometerDifference($entry, $previousEntry);
                $dto->milage = self::getMilage($entry, $dto->odometer_diff);
                $dto->fuel_economy = self::getFuelEconomy($entry, $dto->odometer_diff);

                return $dto;
            })
            ->all();
    }

    private static function getOdometerDifference(self $a, ?self $b): int | null
    {
        if (is_null($b)) {
            return null;
        }
        return $a->odometer_reading - $b->odometer_reading;
    }

    private static function getMilage(self $a, ?int $diff): float | null
    {
        if (is_null($a->fuel_volume) || is_null($diff)) {
            return null;
        }
        return $diff / $a->fuel_volume;
    }

    private static function getFuelEconomy(self $a, ?int $diff): float | null
    {
        if (is_null($a->fuel_volume) || is_null($diff)) {
            return null;
        }
        return $a->fuel_volume / $diff * 100;
    }
}
