<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasFactory;
    protected $table = 'costumer';
    // protected $primaryKey = 'id';
    // protected $fillable = [
    //     'name', 'username', 'email', 'password', 'phone_number', 'status', 'subcribe_date', 'id_product'
    // ];
}
