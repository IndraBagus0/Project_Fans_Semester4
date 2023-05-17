<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'costumer';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id_costumer');
    }
}
