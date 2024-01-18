<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class PurchaseProductController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin and admin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // add cart to purchase product 
    public function index()
    {
        $product = Product::all();
        return view('backend.product.purchase.purchaseproductform', compact('product'));
    }

    // index function to add cart 
    public function addCartToPurchase(Request $request)
    {
        $data = array();
        $data['id'] = $request->id; // product id 
        $data['name'] = $request->name; // product name 
        $data['qty'] = $request->qty; // product purchase quantity 
        $data['price'] = $request->price; // product purchase price 
        $data['options']['total_purchase_price'] = $request->price * $request->qty; // total purchase price 
        $data['options']['selling_price'] = $request->selling_price; // selling price for a single product 
        $data['options']['total_selling_price'] = $request->selling_price * $request->qty; // total selling price 
        $data['options']['note'] = ' ';
        $data['options']['expire_date'] = $request->expire_date; // expired date       

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

    // update cart data for a single product to purchase product 
    public function cartUpdateToPurchase(Request $request, $rowId)
    {
        $data = array();
        $data['qty'] = $request->qty;
        $data['price'] = $request->buying_price;
        $data['options']['total_purchase_price'] = $request->buying_price * $request->qty; // total purchase price 
        $data['options']['selling_price'] = $request->selling_price; // selling price for a single product 
        $data['options']['total_selling_price'] = $request->selling_price * $request->qty; // total selling price 
        $data['options']['note'] = $request->note; // note 
        $data['options']['buy_date'] = $request->buy_date; // buy date 
        $data['options']['expire_date'] = $request->expire_date; // expired date         


        // add requested data to cart 
        Cart::update($rowId, $data);
        $notification = array(
            'message' => 'Cart Update Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // remove cart item 
    public function cartRemoveToPurchase($rowId)
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

    // create invoice for purchasing product 
    public function generateInvoiceToPurchase(Request $request)
    {
        $cart_contents = Cart::content();
        $supplier_name = $request->supplier_name;
        $supplier_address = $request->supplier_address;
        $supplier_phone = $request->supplier_phone;
        return view('backend.product.purchase.invoice', compact('cart_contents', 'supplier_name', 'supplier_address', 'supplier_phone'));
    }

    // final invoice to purchase product 
    public function finalInvoiceForPurchase(Request $request)
    {
        $data = array();
        $data['purchase_date'] = \Today();
        $data['purchase_status'] = $request->purchase_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['supplier_name'] = $request->supplier_name;
        $data['supplier_address'] = $request->supplier_address;
        $data['supplier_phone'] = $request->supplier_phone;

        $purchase_id = DB::table('purchases')->insertGetId($data);

        $cart_content = Cart::content();

        $odata = array();
        foreach ($cart_content as $content) {
            $odata['purchase_id'] = $purchase_id;
            $odata['product_id'] = $content->id;
            $odata['quantity'] =  $content->qty;
            $odata['buying_price'] =  $content->price;
            $odata['total_purchase_price'] =  $content->total;
            $odata['selling_price'] =  $content->options->selling_price;
            $odata['total_selling_price'] =  $content->options->total_selling_price;
            $odata['note'] = $content->options->note; // note 
            $odata['buy_date'] = $content->options->buy_date; // expired date 
            $odata['expire_date'] = $content->options->expire_date; // expired date             

            $insert = DB::table('purchasesdetails')->insert($odata);

            $product = Product::find($content->id);
            $stock_update = $product->stock + $content->qty;
            $product->stock = $stock_update;
            $product->update();
        }

        if ($insert) {
            $notification = array(
                'message' => 'Successfully Invoice Created !',
                'alert-type' => 'success'
            );
            Cart::destroy();
            return Redirect()->route('purchase.product.form')->with($notification);
        } else {
            return Redirect()->back();
        }
    }
}
