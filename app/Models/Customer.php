<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'costumer';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone_number',
        'status',
        'address',
        'subcribe_date',
    ];
    /**
     * Summary of transactions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_costumer');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
