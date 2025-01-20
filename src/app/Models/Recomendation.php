<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recomendation extends Model
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

    public function detailLevelingIndices(): BelongsTo
    {
        return $this->belongsTo(DetailLevelingIndex::class, 'detail_leveling_index_id');
    }

    public function analyze(): HasMany
    {
        return $this->hasMany(Analyze::class, 'recomendation_id');
    }
}
