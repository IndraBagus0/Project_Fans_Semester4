<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $dataUser = User::get();
        return view('pages.data-admin.user-management', compact('dataUser'));
    }
}
