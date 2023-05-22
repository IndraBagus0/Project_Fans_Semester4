<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $user = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'roles' => $request->input('role'), // Menggunakan role_id sebagai nama kolom
            'address' => $request->input('address')
        ];
    
        DB::table('users')->insert($user);

        return redirect()->route('keTambahAdmin')->with('succes', 'Admin berhasil ditambahkan.');
    }
}
