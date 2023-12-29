<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

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
    public function paySalary()
    {
        $employees = Employee::orderBy('id', 'ASC')->get();
        return view('backend.salary.paysalary')->with('employees', $employees);
    }

    // pay salary done function 
    public function paySalaryDone($id)
    {
        $current_year = date("Y"); // creent year
        $current_month = date("F"); // creent month 

        $salary = Salary::where('employee_id', $id)->where('salary_year', $current_year)->where('salary_month', $current_month)->get();

        if ($salary->isNotEmpty()) {
            $notification = array(
                'message' => 'Failed! Because already paid!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $employees = Employee::find($id);
            $salary = new Salary;
            $salary->employee_id = $id;
            $salary->salary_year = $current_year;
            $salary->salary_month = $current_month;
            $salary->paid_amount = $employees->salary;
            $salary->save();

            $notification = array(
                'message' => 'Successfully paid!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    // show all salaries 
    public function showAllSalaries()
    {
        $salaries = Salary::orderBy('id', 'ASC')->get();
        return view('backend.salary.showallsalary')->with('salaries', $salaries);
    }
}
