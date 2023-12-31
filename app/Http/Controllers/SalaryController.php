<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class SalaryController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // pay salary function 
    public function paidSalaryInfo()
    {
        $salary = Salary::all();
        return view('backend.salary.paidsalaryinfo', compact('salary'));
    }

    // pay salary function 
    public function paySalary()
    {
        $employee = Employee::all();
        return view('backend.salary.paysalary', compact('employee'));
    }

    // store salary to the salaries table
    public function storeSalary(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $emp_salary = $employee->salary;

        $check_pay_or_not = Salary::where('employee_id', $request->employee_id)->where('salary_year', $request->salary_year)->where('salary_month', $request->salary_month)->first();
        if ($check_pay_or_not) {
            $notification = array(
                'message' => 'Already Paid',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            // validation set
            $validatedData = $request->validate([
                'employee_id' => ['required', 'max:255'],
                'salary_year' => ['required', 'max:255'],
                'salary_month' => ['required', 'max:255'],
            ]);

            $data = array();
            $data['employee_id'] = $request->employee_id;
            $data['salary_year'] = $request->salary_year;
            $data['salary_month'] = $request->salary_month;
            $data['paid_amount'] = $emp_salary;

            $salary = DB::table('salaries')->insert($data);

            if ($salary) {
                $notification = array(
                    'message' => 'Successfully Paid Salary',
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

    // delete salary
    public function deleteSalary($id)
    {
        $salary = Salary::find($id);

        $delete = $salary->delete();
        $notification = array(
            'message' => 'Salary Delete Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    } // delete salary
}
