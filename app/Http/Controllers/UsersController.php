<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $dataUser = User::with('role')->get();
        return view('pages.data-admin.user-management', compact('dataUser'));
    }


    public function hapus($id)
    {
        User::find($id)->delete();

        // return redirect()->route('keProduk');
        // return response()->json(['status' => 'berhasil']);
        return back()->with('succes', 'Admin Dihapus');
    }
}
