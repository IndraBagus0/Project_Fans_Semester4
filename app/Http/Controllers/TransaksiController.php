<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Produk;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
        $customer = Customer::with('product')
            ->where('status', 'non active')
            ->get();

        return view('pages.transaksi.transaksi', compact('customer'));
    }
    public function edit(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->status = $request->input('status');

        if ($customer->status === 'active') {
            // Atur tanggal subscribe menjadi tanggal sekarang
            $customer->subcribe_date = Carbon::now()->toDateString();

            // Tambahkan 30 hari ke tanggal sekarang
            $expireDate = Carbon::now()->addDays(30)->toDateString();

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

        return back()->with('succes', 'Berhasil');
    }
}
