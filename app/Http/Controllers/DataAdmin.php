<?php

namespace App\Http\Controllers;

use App\Models\User;


class DataAdmin extends Controller
{
    public function show()
    {
        return view('pages.user-management');
    }
}
