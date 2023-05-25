<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return back()->with('success', 'Riwayat dihapus');
    }

    public function pdf(Request $request, $id)
    {
        $riwayat = Transaction::with('customer', 'user')->find($id);
        return view('pages.riwayat.invoice-pdf', compact('riwayat'));
    }
}
