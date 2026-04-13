<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id', 'product_id', 'qty', 'price', 'discount'];

    public function product()     { return $this->belongsTo(Product::class); }
    public function transaction() { return $this->belongsTo(Transaction::class); }

    public function subtotal(): float
    {
        return ($this->price - $this->discount) * $this->qty;
    }
}
