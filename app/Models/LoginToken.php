<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = [
        'expires_at', 'consumed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->isConsumed();
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isBefore(now());
    }

    public function isConsumed(): bool
    {
        return $this->consumed_at !== null;
    }

    public function consume(): void
    {
        $this->consumed_at = now();
        $this->save();
    }
}
