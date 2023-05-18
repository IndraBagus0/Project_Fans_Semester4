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
        $customer = Customer::get();
        return view('pages.data-pelanggan.data-pelanggan', compact('customer'));
    }

    public function edit(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->status = $request->input('status');

        if ($customer->status === 'active') {
            // Atur tanggal subscribe menjadi tanggal sekarang
            $customer->subcribe_date = Carbon::now()->toDateString();

            // Tambahkan 30 hari ke tanggal sekarang
            // $expireDate = Carbon::now()->addDays(30)->toDateString();

            // Tambahkan 1 menit ke tanggal sekarang
            $expireDate = Carbon::now()->addMinutes(1)->toDateString();

            // Buat schedule untuk mengubah status menjadi non active setelah 30 hari
            Schedule::create([
                'customer_id' => $customer->id,
                'status' => 'non active',
                'expire_date' => $expireDate,
            ]);
        } else {
            // Hapus schedule jika status bukan active
            Schedule::where('customer_id', $customer->id)->delete();
            $customer->subcribe_date = null;
        }

        $customer->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
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
