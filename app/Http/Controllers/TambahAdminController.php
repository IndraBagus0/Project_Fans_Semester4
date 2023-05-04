<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUser;

class TambahAdminController extends Controller
{

    public function index()
    {
        return view('pages.tambah-admin.tambah-admin');
    }
}
