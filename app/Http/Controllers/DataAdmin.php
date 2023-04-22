<?php

namespace App\Http\Controllers;

use App\Models\User;


class DataAdmin extends Controller
{
    public function index()
    {
        return view('user-management.pages ', [
            'users' => User::all()
        ]);
    }
}
