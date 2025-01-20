<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailLevelingIndex extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function levelingIndices(): BelongsTo
    {
        return $this->belongsTo(LevelingIndex::class, 'leveling_index_id');
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class, 'indicator_id');
    }

    public function recomendation(): HasMany
    {
        return $this->hasMany(Recomendation::class, 'detail_leveling_index_id');
    }

    public function analyze(): HasMany
    {
        return $this->hasMany(Analyze::class, 'detail_leveling_index_id');
    }
}
