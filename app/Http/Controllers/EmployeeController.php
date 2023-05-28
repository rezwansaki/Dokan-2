<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
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
        $employees = Employee::all();
        return view('backend.employee.allemployee', compact('employees'));
    }

    // to show the form for add employee
    public function addEmployee()
    {
        return view('backend.employee.addemployee');
    }

    // to store employee data in database table
    public function storeEmployee(Request $request)
    {
        $upload_max_filesize = Setting::all()->first()->upload_max_filesize;

        // validation set
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users', 'max:255'],
            'phone' => ['max:32'],
            'nid_no' => ['max:32'],
            'address' => ['max:255'],
            'city' => ['max:32'],
            'salary' => ['max:32'],
            'vacation' => ['max:5'],
            'experience' => ['max:255'],
            'photo' => ['mimes:jpeg,jpg,png', 'max:' . $upload_max_filesize], //maximum file size in KB 
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['nid_no'] = $request->nid_no;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['salary'] = $request->salary;
        $data['vacation'] = $request->vacation;
        $data['experience'] = $request->experience;
        $data['created_at'] = new \DateTime();
        $data['updated_at'] = new \DateTime();
        $image = $request->file('photo');

        if ($image) {
            $image_name = Str::random(5) . '_' . date("Ymdhmsa"); //ex: pM3uM_20230526050535pm.jpg
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $public_path = public_path();
            $image_location = '/my_contents/uploads/employee/';
            $upload_path = $public_path . $image_location; //for image upload in a folder 
            $image_url = $image_location . $image_full_name; //for image store in database table
            $success = $image->storeAs('/uploads/employee/', $image_full_name, 'public');
            if ($success) {
                $data['photo'] = $image_url;
                $user = DB::table('employees')->insert($data);
                if ($user) {
                    $notification = array(
                        'message' => 'Successfully Employee Inserted',
                        'alert-type' => 'success'
                    );
                    return Redirect()->route('all.employee')->with($notification);
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
    } // add employee
}
