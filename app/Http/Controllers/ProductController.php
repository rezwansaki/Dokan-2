<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // show all employees 
    public function index()
    {
        $products = Product::paginate(12);
        return view('backend.product.allproducts', compact('products'));
    }

    // add product function 
    public function addProduct()
    {
        return view('backend.product.addProduct');
    }

    // insert product function 
    public function storeProduct(Request $request)
    {
        $upload_max_filesize = Setting::all()->first()->upload_max_filesize;

        // validation set
        $validatedData = $request->validate([
            'product_name' => ['required', 'max:255'],
            'product_description' => ['required', 'max:255'],
            'buy_date' => ['required'],
            'expire_date' => ['required'],
            'buying_price' => ['required'],
            'selling_price' => ['required'],
            'stock' => ['required'],
            'product_image' => ['mimes:jpeg,jpg,png', 'max:' . $upload_max_filesize], //maximum file size in KB 
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['stock'] = $request->stock;
        $image = $request->file('product_image');

        if ($image) {
            $image_name = Str::random(5) . '_' . date("Ymdhmsa"); //ex: pM3uM_20230526050535pm.jpg
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $public_path = public_path();
            $image_location = '/my_contents/uploads/product/';
            $upload_path = $public_path . $image_location; //for image upload in a folder 
            $image_url = $image_location . $image_full_name; //for image store in database table
            $success = $image->storeAs('/uploads/product/', $image_full_name, 'public');
            if ($success) {
                $data['product_image'] = $image_url;
                $user = DB::table('products')->insert($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Successfully Product Inserted',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.products')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Error',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            } else {
                return Redirect()->back();
            }
        } else {
            return Redirect()->back();
        }
    }

    // to show form for edit product
    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('backend.product.editproduct', compact('product'));
    } // edit product 

    // update product
    public function updateProduct(Request $request, $id)
    {
        $upload_max_filesize = Setting::all()->first()->upload_max_filesize;

        // validation set
        $validatedData = $request->validate([
            'product_name' => ['max:255'],
            'product_description' => ['max:255'],
            'buy_date' => ['max:255'],
            'expire_date' => ['max:255'],
            'buying_price' => ['max:255'],
            'selling_price' => ['max:255'],
            'stock' => ['max:255'],
            'product_image' => ['mimes:jpeg,jpg,png', 'max:' . $upload_max_filesize], //maximum file size in KB 
        ]);

        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['stock'] = $request->stock;
        $image = $request->file('product_image');

        if ($image) { //with image
            $image_name = Str::random(5) . '_' . date("Ymdhmsa"); //ex: pM3uM_20230526050535pm.jpg
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $public_path = public_path();
            $image_location = '/my_contents/uploads/product/';
            $upload_path = $public_path . $image_location; //for image upload in a folder 
            $image_url = $image_location . $image_full_name; //for image store in database table
            $success = $image->storeAs('/uploads/product/', $image_full_name, 'public');
            if ($success) {
                $data['product_image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->product_image;
                if ($image_path) {
                    $done = unlink(public_path() . $image_path); //to remove image from folder
                }
                $user = DB::table('products')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Product Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.products')->with($notification);
                } else {
                    return Redirect()->back();
                }
            } else {
                return Redirect()->back();
            }
        } else { //without image
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['product_image'] = $oldphoto;
                $user = DB::table('products')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Product Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.products')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        }
    } // update Product

    // delete product
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $image_path = $product->product_image;
        if ($image_path) {
            $done = unlink(public_path() . $image_path); //to remove image from folder
        }
        $delete = $product->delete();
        $notification = array(
            'message' => 'Product Delete Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.products')->with($notification);
    } // delete product

    // purchase product form
    public function purchaseproductForm()
    {
        $products = Product::all();
        return view('backend.product.purchaseproductform', compact('products'));
    }

    // purchase product 
    public function purchaseProduct(Request $request)
    {
        // validation set
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required'],
            'buying_price' => ['required'],
            'total_purchase_price' => ['required'],
            'selling_price' => ['required'],
            'total_selling_price' => ['required'],
            'note' => ['required'],
            'buy_date' => ['required'],
            'expire_date' => ['required'],
            'supplier_name' => ['required'],
            'supplier_address' => ['required'],
            'supplier_phone' => ['required']
        ]);

        $data = array();
        $data['product_id'] = $request->product_id;
        $data['quantity'] = $request->quantity;
        $data['buying_price'] = $request->buying_price;
        $data['total_purchase_price'] = $request->total_purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['total_selling_price'] = $request->total_selling_price;
        $data['note'] = $request->note;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['supplier_name'] = $request->supplier_name;
        $data['supplier_address'] = $request->supplier_address;
        $data['supplier_phone'] = $request->supplier_phone;
        $data['created_at'] = new \DateTime();
        $data['updated_at'] = new \DateTime();

        $success = DB::table('purchases')->insert($data);
        if ($success) {
            $productInfo = Product::find($request->product_id);
            $productOldStock = $productInfo->stock;
            // update product stock
            $pdata['buy_date'] = $request->buy_date;
            $pdata['expire_date'] = $request->expire_date;
            $pdata['buying_price'] = $request->buying_price;
            $pdata['selling_price'] = $request->selling_price;
            $pdata['stock'] = $productOldStock + $request->quantity;
            DB::table('products')->where('id', $request->product_id)->update($pdata);
            $notification = array(
                'message' => 'Successfully purchase the product',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
