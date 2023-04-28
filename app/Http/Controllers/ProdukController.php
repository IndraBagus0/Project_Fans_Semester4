<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    //Read Data Produk
    public function index()
    {
        $produk = Produk::get();
        return view('pages.produk', compact('produk'));
    }
    //Menambah Data Produk

}
