<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = ['name_product', 'speed', 'price', 'bandwith', 'foto'];

    public function costumers()
    {
        return $this->hasMany(Customer::class, 'id_product');
    }
}
