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
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id_costumer');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'id');
    }
}
