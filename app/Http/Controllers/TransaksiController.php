<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
        $customer = Customer::get();
        return view('pages.transaksi.transaksi', compact('customer'));
    }
    public function hapus($id)
    {
        Customer::find($id)->delete();
        return back()->with('succes', 'Transaksi dihapus');
    }
}
