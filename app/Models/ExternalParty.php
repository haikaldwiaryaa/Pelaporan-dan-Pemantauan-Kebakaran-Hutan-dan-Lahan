<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExternalParty extends Model
{
    protected $fillable = [
        'name',
        'contact',
    ];

    public function forwardings(): HasMany
    {
        return $this->hasMany(Forwarding::class);
    }
}