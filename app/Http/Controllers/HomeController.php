<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $costumer = Costumer::Count();
        // return view('pages.dashboard', ['costumer' => $costumer]);
        $countCostumer = Customer::count();
        $countActive = Customer::where('status', 'active')->count();
        $countNonActive = Customer::where('status', 'nonactive')->count();
        return view('pages.dashboard', compact('countCostumer', 'countActive', 'countNonActive'));
    }
}
