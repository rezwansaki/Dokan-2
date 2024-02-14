<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

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
    public function allOrderdetails($orderId)
    {
        $orderdetails = OrderDetails::where('order_id', $orderId)->get();
        return view('backend.orders.orderdetails', compact('orderdetails', 'orderId'));
    }

    // to show all orders from orders table which payment status is not due  
    public function allIncome()
    {
        $income = Order::where('pay', '>', 0)->get();
        $total_income = Order::where('pay', '>', 0)->sum('pay');
        return view('backend.income.income', compact('income', 'total_income'));
    }
}
