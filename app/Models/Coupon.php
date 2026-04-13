<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'shop_id', 'code', 'description', 'type', 'value',
        'max_uses', 'used_count', 'expires_at', 'is_active',
    ];

    protected $casts = ['expires_at' => 'date', 'is_active' => 'boolean'];

    public function shop() { return $this->belongsTo(Shop::class); }

    public function isValid(): bool
    {
        if (!$this->is_active) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) return false;
        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        return $this->type === 'percent'
            ? round($subtotal * $this->value / 100, 2)
            : min((float) $this->value, $subtotal);
    }
}
