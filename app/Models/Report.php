<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    public const AREAS = ['Kampar', 'Pelalawan', 'Siak', 'Bengkalis', 'Indragiri Hulu'];
    public const CONDITION_LEVELS = ['asap_tipis', 'asap_tebal', 'api_terlihat'];
    protected $fillable = [
        'user_id',
        'description',
        'condition_level',
        'incident_at',
        'area',
        'location_detail',
        'latitude',
        'longitude',
        'evidence_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'incident_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewNotes(): HasMany
    {
        return $this->hasMany(ReviewNote::class);
    }

    public function forwardings(): HasMany
    {
        return $this->hasMany(Forwarding::class);
    }
}