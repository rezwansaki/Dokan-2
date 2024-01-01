<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin and admin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // index 
    public function index()
    {
        $product = Product::all();
        return view('backend.pos.pos', compact('product'));
    }
}
