<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ListProduk extends Controller
{
    public function index()
    {
        return view('tables', [
            'produks' =>  Produk::all()
        ]);
    }
}
