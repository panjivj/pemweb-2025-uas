<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indicator extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function levelingIndices(): HasMany
    {
        return $this->hasMany(LevelingIndex::class, 'indicator_id');
    }

    public function detailLevelingIndices(): HasMany
    {
        return $this->hasMany(DetailLevelingIndex::class, 'indicator_id');
    }

    public function recomendation(): HasMany
    {
        return $this->hasMany(Recomendation::class, 'indicator_id');
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }

    public function aspect(): BelongsTo
    {
        return $this->belongsTo(Aspect::class, 'aspect_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function analyze(): HasMany
    {
        return $this->hasMany(Analyze::class, 'indicator_id');
    }
}
