<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $request->validate([
            'name_product' => 'required',
            'speed' => 'required',
            'price' => 'required',
            'bandwith' => 'required',
            'foto' => 'required|image|max:2048', // Validasi file foto sebagai gambar maksimal 2MB
        ]);

        // Mendapatkan file yang diunggah dari input form
        $file = $request->file('foto');

        // Membuat nama file baru dengan timestamp
        $namaFile = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

        // Menyimpan file ke direktori public/storage/foto_produk dengan nama file baru
        $path = $file->storeAs('foto_produk', $namaFile, 'public');

        // Menyimpan data produk beserta nama file foto ke dalam database
        $product = new Produk();
        $product->name_product = $request->input('name_product');
        $product->speed = $request->input('speed');
        $product->price = $request->input('price');
        $product->bandwith = $request->input('bandwith');
        $product->foto = $namaFile;
        $product->save();

        return redirect()->route('keProduk')->with('succes', 'Produk berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $product = Produk::find($id);

        return view('pages.produk.produk', ['product' => $product]);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name_product' => 'required|string|max:255',
            'speed' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'bandwith' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048', // Jika foto diunggah, pastikan itu adalah file gambar dengan ukuran maksimum 2MB
        ]);

        // Temukan produk berdasarkan ID
        $product = Produk::findOrFail($id);

        // Update atribut-atribut produk
        $product->name_product = $request->input('name_product');
        $product->speed = $request->input('speed');
        $product->price = $request->input('price');
        $product->bandwith = $request->input('bandwith');

        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Validasi dan hapus foto lama jika ada
            if ($product->foto !== null) {
                Storage::delete('public/foto_produk/' . $product->foto);
            }

            // Mendapatkan file yang diunggah dari input form
            $file = $request->file('foto');

            // Membuat nama file baru dengan timestamp
            $namaFile = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // Menyimpan file ke direktori public/storage/foto_produk dengan nama file baru
            $path = $file->storeAs('foto_produk', $namaFile, 'public');

            // Update nama file foto baru pada produk
            $product->foto = $namaFile;
        }

        // Simpan perubahan ke database
        $product->save();

        // Redirect ke halaman produk atau tampilkan pesan sukses
        return redirect()->route('keProduk')->with('succes', 'Produk berhasil diperbarui.');
    }
    public function hapus($id)
    {
        Produk::find($id)->delete();

        // return redirect()->route('keProduk');
        // return response()->json(['status' => 'berhasil']);
        return back()->with('succes', 'Produk Dihapus');
    }
}
