<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    //
    public function index()
    {
        $customer = Customer::get();
        return view('pages.data-pelanggan.data-pelanggan', compact('customer'));
    }
    public function hapus($id)
    {
        Customer::find($id)->delete();
        return back()->with('succes', 'Pelanggan dihapus');
    }
}
