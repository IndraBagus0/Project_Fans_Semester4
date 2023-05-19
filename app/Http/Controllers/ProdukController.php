<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $product = Produk::get();
        return view('pages.produk.produk', compact('product'));
    }


    public function tambah()
    {
        return view('pages.produk.form_produk');
    }

    public function simpan(Request $request)
    {
        $product = [
            'id' => $request->id,
            'name_product' => $request->name_product,
            'speed' => $request->speed,
            'price' => $request->price,
            'bandwith' => $request->bandwith,
        ];

        produk::create($product);
        return back()->with('succes', 'Produk Berhasil Ditambah');
    }
    public function edit($id)
    {
        $product = Produk::find($id);

        return view('pages.produk.produk', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_product' => 'required',
            'speed' => 'required|numeric',
            'price' => 'required|numeric',
            'bandwith' => 'required|numeric',
        ]);

        $product = Produk::find($id);
        $product->name_product = $request->name_product;
        $product->speed = $request->speed;
        $product->price = $request->price;
        $product->bandwith = $request->bandwith;
        $product->save();

        return back()->with('success', 'Produk Diupdate');
    }
    public function hapus($id)
    {
        Produk::find($id)->delete();

        // return redirect()->route('keProduk');
        // return response()->json(['status' => 'berhasil']);
        return back()->with('succes', 'Produk Dihapus');
    }
}
