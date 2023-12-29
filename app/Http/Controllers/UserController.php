<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin and admin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // to view a single user profile
    public function viewSingleUser($id)
    {
        $user = User::find($id);
        return view('backend.users.viewuser', compact('user'));
    } // to view a single user profile


    // to show the form for add user
    public function addUser()
    {
        return view('backend.users.adduser');
    }

    // to store user data in database table
    public function storeUser(Request $request)
    {
        $upload_max_filesize = Setting::all()->first()->upload_max_filesize;

        // validation set
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'max:32'],
            'address' => ['required', 'max:255'],
            'photo' => ['required', 'mimes:jpeg,jpg,png', 'max:' . $upload_max_filesize], //maximum file size in KB 
            'role' => ['required', 'max:32'],
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['role'] = $request->role;
        $data['created_at'] = new \DateTime();
        $data['updated_at'] = new \DateTime();
        $image = $request->file('photo');

        if ($image) {
            $image_name = Str::random(5) . '_' . date("Ymdhmsa"); //ex: pM3uM_20230526050535pm.jpg
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $public_path = public_path();
            $image_location = '/my_contents/uploads/user/';
            $upload_path = $public_path . $image_location; //for image upload in a folder 
            $image_url = $image_location . $image_full_name; //for image store in database table
            $success = $image->storeAs('/uploads/user/', $image_full_name, 'public');
            if ($success) {
                $data['photo'] = $image_url;
                $user = DB::table('users')->insert($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Successfully User Inserted',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.users')->with($notification);
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
    } // add user

    // to show all users 
    public function allUsers()
    {
        $all_users = User::all();
        return view('backend.users.allusers', compact('all_users'));
    } // all users

    // to show form for edit user
    public function editUser($id)
    {
        // check clicked row is super admin or not 
        $checkSuperAdmin = User::where('id', '=', $id)->where('role', '=', 2)->first(); // 'role = 2' means 'super admin'

        if (Auth::user()->role == 2) { // when authenticated user is a super admin 
            $user = User::find($id);
            return view('backend.users.edituser', compact('user'));
        } else { // when authenticated user is not a super admin 
            if ($checkSuperAdmin) { // check cliked row is a super admin 
                $notification = array(
                    'message' => 'You are not a SuperAdmin.',
                    'alert-type' => 'warning'
                );
                return Redirect()->back()->with($notification);
            } else { // check cliked row is a not a super admin 
                $user = User::find($id);
                return view('backend.users.edituser', compact('user'));
            }
        }
    } // edit user

    // update user
    public function updateUser(Request $request, $id)
    {
        $upload_max_filesize = Setting::all()->first()->upload_max_filesize;

        // validation set
        $validatedData = $request->validate([
            'name' => ['max:255'],
            'email' => ['max:255'],
            'phone' => ['max:32'],
            'address' => ['max:255'],
            'photo' => ['mimes:jpeg,jpg,png', 'max:' . $upload_max_filesize], //maximum file size in KB 
            'role' => ['max:32'],
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['role'] = $request->role;
        $data['updated_at'] = new \DateTime();
        $image = $request->file('photo');

        if ($image) { //with image
            $image_name = Str::random(5) . '_' . date("Ymdhmsa"); //ex: pM3uM_20230526050535pm.jpg
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $public_path = public_path();
            $image_location = '/my_contents/uploads/user/';
            $upload_path = $public_path . $image_location; //for image upload in a folder 
            $image_url = $image_location . $image_full_name; //for image store in database table
            $success = $image->storeAs('/uploads/user/', $image_full_name, 'public');
            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('users')->where('id', $id)->first();
                $image_path = $img->photo;
                if ($image_path) {
                    $done = unlink(public_path() . $image_path); //to remove image from folder
                }
                $user = DB::table('users')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'User Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.users')->with($notification);
                } else {
                    return Redirect()->back();
                }
            } else {
                return Redirect()->back();
            }
        } else { //without image
            $oldphoto = $request->old_photo;
            if ($oldphoto) {
                $data['photo'] = $oldphoto;
                $user = DB::table('users')->where('id', $id)->update($data);
                if ($user) {
                    $notification = array(
                        'message' => 'User Update Successfully',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.users')->with($notification);
                } else {
                    return Redirect()->back();
                }
            }
        }
    } // update user

    // delete user
    public function deleteUser($id)
    {
        // check clicked row is super admin or not 
        $checkSuperAdmin = User::where('id', '=', $id)->where('role', '=', 2)->first(); // 'role = 2' means 'super admin'

        if (Auth::user()->role == 2) { // when authenticated user is a super admin 
            $user = User::find($id);
            $image_path = $user->photo;
            if ($image_path) {
                $done = unlink(public_path() . $image_path); //to remove image from folder
            }
            $delete = $user->delete();
            $notification = array(
                'message' => 'User Delete Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.users')->with($notification);
        } else { // when authenticated user is not a super admin 
            if ($checkSuperAdmin) { // check cliked row is a super admin 
                $notification = array(
                    'message' => 'You are not a SuperAdmin.',
                    'alert-type' => 'warning'
                );
                return Redirect()->back()->with($notification);
            } else { // check cliked row is a not a super admin 
                $user = User::find($id);
                $image_path = $user->photo;
                if ($image_path) {
                    $done = unlink(public_path() . $image_path); //to remove image from folder
                }
                $delete = $user->delete();
                $notification = array(
                    'message' => 'User Delete Successfully',
                    'alert-type' => 'success'
                );
                return Redirect()->route('all.users')->with($notification);
            }
        }
    } // delete user
}
