<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = date('d-M-Y');
        $todayOrders = Order::where('order_date', $today)->sum('pay');
        $currentTotalEmployees = Employee::count('id');
        $totalProducts = Product::count('id');
        return view('backend.home', compact('todayOrders', 'currentTotalEmployees', 'totalProducts'));
    }
}
