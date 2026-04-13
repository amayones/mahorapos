<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashierShift extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'shop_id', 'cashier_id', 'opening_cash', 'closing_cash',
        'expected_cash', 'cash_difference', 'opened_at', 'closed_at', 'note',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function cashier()      { return $this->belongsTo(User::class, 'cashier_id'); }
    public function transactions() { return $this->hasMany(Transaction::class, 'shift_id'); }

    public function isOpen(): bool
    {
        return is_null($this->closed_at);
    }
}
