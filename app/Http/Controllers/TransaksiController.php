<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class TransaksiController extends Controller
{
    public function index()
    {
        // $customer = Customer::get();
        // $customer = Customer::where('status', 'non active')->get();
        $customer = Customer::join('product', 'costumer.id_product', '=', 'product.id')
            ->select('costumer.*', 'product.name_product', 'product.speed', 'product.price', 'product.bandwith')
            ->where('costumer.status', 'non active')
            ->get();
        $products = Produk::all();

        return view('pages.transaksi.transaksi', compact('customer', 'products'));
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
    public function ubah(Request $request, $id)
    {
        // Retrieve the selected product from the request
        $selectedProduct = $request->input('selected_product');

        // Find the customer by their ID
        $customer = Customer::findOrFail($id);

        // Update the product column
        $customer->id_product = $selectedProduct;
        $customer->save();

        // Redirect back or perform any other necessary actions
        return back()->with('succes', 'Berhasil');
    }
}
