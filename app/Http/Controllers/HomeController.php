<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
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
        $countCostumer = Costumer::count();
        $countActive = Costumer::where('status', 'active')->count();
        $countNonActive = Costumer::where('status', 'nonactive')->count();
        return view('pages.dashboard', compact('countCostumer', 'countActive', 'countNonActive'));
    }
}
