<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DataPelangganController extends Controller
{
    //
    public function index()
    {
        $customer = Customer::orderBy('status', 'desc')->get();
        return view('pages.data-pelanggan.data-pelanggan', compact('customer'));
    }
    

    public function edit($id)
    {
        // Mengambil data pengguna berdasarkan ID
        $user = Customer::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        // Mengubah status menjadi "non active" hanya jika status sebelumnya bukan "non active"
        if ($user->status !== 'non active') {
            // Cek jika status sebelumnya adalah "active"
            if ($user->status === 'active') {
                // Set "subscribe_date" menjadi null
                $user->subcribe_date = null;
            }
            $user->status = 'non active';
        } else {
            return redirect()->back()->with('error', 'Status Pelanggan Tidak Aktif Tidak Bisa DI Ubah ');
        }

        // Menyimpan perubahan
        $user->save();

        return redirect()->back()->with('succes', 'Status berhasil diubah menjadi tidak aktif');
    }


    public function hapus($id)
    {
        // Temukan data yang akan dihapus berdasarkan id
        $pelanggan = Customer::find($id);

        if (!$pelanggan) {
            // Tangani jika data tidak ditemukan
            return redirect()->back()->with('error', 'Transaksi pelanggan tidak ditemukan.');
        }

        // Hapus data
        $pelanggan->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('succes', 'Transaksi pelanggan berhasil dihapus.');
    }
}
