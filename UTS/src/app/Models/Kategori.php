<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
