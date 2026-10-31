<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Forwarding extends Model
{
    protected $fillable = [
        'report_id',
        'external_party_id',
        'user_id',
        'forwarded_at',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'forwarded_at' => 'datetime',
        ];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function externalParty(): BelongsTo
    {
        return $this->belongsTo(ExternalParty::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}