<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function show()
    {
        $produk = Produk::get();
        return view('pages.produk', compact('produk'));
    }
}
