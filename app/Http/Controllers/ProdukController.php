<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::get();
        return view('pages.produk.produk', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        return view('pages.produk.form_produk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        $produk = [
            'id' => $request->id,
            'nama_produk' => $request->nama_produk,
            'kecepatan' => $request->kecepatan,
            'harga_produk' => $request->harga_produk,
            'bandwith' => $request->bandwith,
        ];

        produk::create($produk);
        return back()->with('succes', 'Produk Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id)->first();


        return view('barang.form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kecepatan' => 'required|numeric',
            'harga_produk' => 'required|numeric',
            'bandwith' => 'required|numeric',
        ]);

        $produk->update($request->all());

        return back()->with('succes', 'Produk Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        Produk::find($id)->delete();

        // return redirect()->route('keProduk');
        // return response()->json(['status' => 'berhasil']);
        return back()->with('succes', 'Produk Dihapus');
    }
}
