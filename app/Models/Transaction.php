<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['shop_id', 'cashier_id', 'total'];

    public function shop()     { return $this->belongsTo(Shop::class); }
    public function cashier()  { return $this->belongsTo(User::class, 'cashier_id'); }
    public function items()    { return $this->hasMany(TransactionItem::class); }
}
