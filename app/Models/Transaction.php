<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'shop_id', 'cashier_id', 'shift_id', 'coupon_id',
        'subtotal', 'discount_amount', 'tax_amount', 'total',
        'cash_paid', 'change_amount', 'payment_method', 'status', 'note',
    ];

    public function shop()    { return $this->belongsTo(Shop::class); }
    public function cashier() { return $this->belongsTo(User::class, 'cashier_id'); }
    public function shift()   { return $this->belongsTo(CashierShift::class); }
    public function coupon()  { return $this->belongsTo(Coupon::class); }
    public function items()   { return $this->hasMany(TransactionItem::class); }
}
