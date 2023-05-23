<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = ['customer_id', 'status', 'expire_date'];
    public function customer()
    {
        return $this->hasMany(Customer::class, 'customer_id');
    }
}
