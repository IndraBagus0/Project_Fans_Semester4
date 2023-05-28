<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\RiwayatExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
    public function export()
    {
        return Excel::download(new RiwayatExport, 'Riwayat.xlsx');
    }
}
