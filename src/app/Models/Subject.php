<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function indicator(): HasMany
    {
        return $this->hasMany(Indicator::class, 'subject_id');
    }

    public function analyze(): HasMany
    {
        return $this->hasMany(Analyze::class, 'subject_id');
    }

    public function detailUser(): HasMany
    {
        return $this->hasMany(DetailUser::class, 'user_id');
    }

}
