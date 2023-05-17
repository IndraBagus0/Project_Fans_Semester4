<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Transaction::with('customer', 'user')->get();
        return view('pages.riwayat.riwayat', compact('riwayat'));
    }
    public function hapus($id)
    {
        Transaction::find($id)->delete();
        return back()->with('succes', 'Riwayat dihapus');
    }
}
