<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahAdminController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('pages.tambah-admin.tambah-admin', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('pages.tambah-admin.tambah-admin', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'role' => 'required|exists:roles,id',
            'address' => 'required|string|max:100',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->roles = $request->input('role'); // Menggunakan role_id sebagai nama kolom
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('keTambahAdmin')->with('succes', 'Admin berhasil ditambahkan.');
    }
}
