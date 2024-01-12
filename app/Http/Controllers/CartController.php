<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $product = Product::find($request->product_id);
        $stock = $product->stock;

        if ($request->qty <= $product->stock) {
            // add requested data to cart 
            Cart::update($rowId, $data);
            $cart_update = Cart::get($rowId);

            $product->stock = $product->stock - $cart_update->qty;
            $product->save();
            $notification = array(
                'message' => 'Cart Update Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Out of stock! There are total ' . $stock . ' products in stock.',
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
        $customer = $request->customer;
        $contact = $request->contact;
        return view('backend.invoice.invoice', compact('cart_contents', 'customer', 'contact'));
    }

    // final invoice 
    public function finalInvoice(Request $request)
    {
        $data = array();
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;

        $order_id = DB::table('orders')->insertGetId($data);
        $cart_content = Cart::content();

        $odata = array();
        foreach ($cart_content as $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->id;
            $odata['quantity'] =  $content->qty;
            $odata['unit_cost'] =  $content->price;
            $odata['total'] =  $content->total;

            $insert = DB::table('order_details')->insert($odata);

            $product = Product::find($content->id);
            $stock_update = $product->stock - $content->qty;
            $product->stock = $stock_update;
            $product->update();
        }

        if ($insert) {
            $notification = array(
                'message' => 'Successfully Invoice Created ! Please, deliver the products and accept status.',
                'alert-type' => 'success'
            );
            Cart::destroy();
            return Redirect()->route('pos')->with($notification);
        } else {
            return Redirect()->back();
        }
    }
}
