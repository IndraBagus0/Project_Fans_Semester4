<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class TambahAdminController extends Controller
{

    public function index()
    {
        $roles = Role::all(); // Mengambil semua data roles dari model Role (asumsikan model Role digunakan untuk tabel roles)
        return view('pages.tambah-admin.tambah-admin', ['roles' => $roles]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        try {
            $admin = new User();
            $admin->name = $request->input('name');
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->address = $request->input('address');
            $admin->save();

            $roles = $request->input('roles', []);

            $admin->roles()->sync($roles);

            return 'Admin user added successfully!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
