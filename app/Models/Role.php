<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    protected $table = 'roles';

    public function User()
    {
        return $this->hasMany(User::class);
    }
}
