<?php

namespace App\Models;

use App\Models\MilageEntry;
use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['name', 'color', 'owner_id'];
    protected $guarded = ['owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function milageEntries()
    {
        return $this->hasMany(MilageEntry::class);
    }
}
