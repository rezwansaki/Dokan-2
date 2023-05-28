<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    // install at the first time 
    public function index()
    {
        // check Super Admin is exist or not
        $user = User::all()->where('role', 2)->first(); //user role '2' means 'superadmin'
        if (!$user) {
            return view('backend.install');
        } else {
            $notification = array(
                'message' => 'Super Admin is already exist! No need to install again!',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function create(Request $request)
    {
        // check Super Admin is exist or not
        $user = User::where('role', 2)->first(); //user role '2' means 'superadmin'
        if (!$user) {
            $validatedData = $request->validate([
                'name' => ['required', 'unique:users', 'max:255'],
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $userData = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $userUpdate = User::where('role', '0')->update(['role' => '2']);

            $settingData = Setting::create([
                'install_the_project' => 1,
                'shop_name' => "Dokan-2",
                'shop_description' => "An inventory management system.",
                'shop_location' => "Mirpur, Dhaka, Bangladesh.",
                'upload_max_filesize' => 150,
            ]);

            return redirect('login');
        } else {
            $notification = array(
                'message' => 'Super Admin is already exist! No need to install again!',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
