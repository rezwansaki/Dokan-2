<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // to show all orders from orders table 
    public function allOrders()
    {
        $orders = Order::all();
        return view('backend.orders.allorder', compact('orders'));
    }

    // to show all orders from orders table 
    public function allOrderdetails()
    {
        $orderdetails = OrderDetails::all();
        return view('backend.orders.allorderdetails', compact('orderdetails'));
    }

    // to show all orders from orders table which payment status is not due  
    public function allIncome()
    {
        $income = Order::where('payment_status', '!=', 'Due')->get();
        return view('backend.income.income', compact('income'));
    }
}
