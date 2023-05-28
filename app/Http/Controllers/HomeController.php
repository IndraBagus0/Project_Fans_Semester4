<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{

    public function index()
    {
        // $costumer = Costumer::Count();
        // return view('pages.dashboard', ['costumer' => $costumer]);
        $countCostumer = Customer::count();
        $countActive = Customer::where('status', 'active')->count();
        $countNonActive = Customer::where('status', 'non active')->count();
        $pendapatan = Transaction::sum('total');
        $customer = Customer::join('product', 'costumer.id_product', '=', 'product.id')
            ->select('costumer.*', 'product.name_product', 'product.speed', 'product.price', 'product.bandwith')
            ->where('costumer.status', 'active')
            ->get();
        $product = Produk::get();
        $riwayat = Transaction::with('customer', 'user')->orderBy('created_at', 'desc')->get();
        return view('pages.dashboard', compact('countCostumer', 'countActive', 'countNonActive', 'pendapatan', 'customer', 'product', 'riwayat'));
    }
}
