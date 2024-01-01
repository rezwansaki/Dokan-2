<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin and admin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // index function to add cart 
    public function index(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['price'] = $request->price;

        // add requested data to cart 
        $add = Cart::add($data);

        if ($add) {
            $notification = array(
                'message' => 'Cart Added Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Cart Added Failed',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // update cart data for a single product quantity 
    public function cartUpdate(Request $request, $rowId)
    {
        $data = array();
        $data['qty'] = $request->qty;

        // add requested data to cart 
        $update = Cart::update($rowId, $data);

        if ($update) {
            $notification = array(
                'message' => 'Cart Update Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Cart Update Failed',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // remove cart item 
    public function cartRemove($rowId)
    {
        $remove = Cart::remove($rowId);

        if ($remove) {
            $notification = array(
                'message' => 'Cart Remove Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Cart Remove Failed',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // create invoice 
    public function createInvoice(Request $request)
    {
        $cart_contents = Cart::content();
        return view('backend.invoice.invoice', compact('cart_contents'));
    }
}
