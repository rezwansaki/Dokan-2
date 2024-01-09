<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    // to protect this controller from unauthenticated users 
    public function __construct()
    {
        // Only Superadmin can access all the functions of this controller 
        $this->middleware('adminandsuperadmin');
    }

    // show form to create expense
    public function index()
    {
        $expense = Expense::all();
        return view('backend.expense.expense', compact('expense'));
    }

    // store expense to expenses table 
    public function storeExpense(Request $request)
    {
        // validation set
        $validatedData = $request->validate([
            'exp_desc' => ['required', 'max:255'],
            'exp_date' => ['required'],
            'exp_amount' => ['required'],
        ]);

        $data = array();
        $data['exp_desc'] =  $request->exp_desc;
        $data['exp_date'] = date('d-M-Y', strtotime($request->exp_date));
        $data['exp_amount'] = $request->exp_amount;

        $success = DB::table('expenses')->insert($data);
        if ($success) {
            $notification = array(
                'message' => 'Successfully Expense Inserted',
                'alert-type' => 'success'
            );
            return Redirect()->route('add.expense')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
