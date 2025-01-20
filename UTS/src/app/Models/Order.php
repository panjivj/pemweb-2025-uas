<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function detailUser(): BelongsTo
    {
        return $this->belongsTo(DetailUser::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            $menu = Menu::find($order->menu_id);
            if ($menu && $menu->is_available) {
                $order->price = $menu->price;
                $order->totalprice = $menu->price * $order->jumlah;
            }
        });

        static::updating(function ($order) {
            $menu = Menu::find($order->menu_id);
            if ($menu && $menu->is_available) {
                $order->price = $menu->price;
                $order->totalprice = $menu->price * $order->jumlah;
            }
        });
    }

}
