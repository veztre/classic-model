<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class EmployeeController extends BaseController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['dashboard']);
    }

    /**
     * Show the employee dashboard with assigned customers.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect('/')->with('error', 'No employee record found for your account.');
        }

        $customers = $employee->customers()->paginate(15);

        return view('employee.dashboard', compact('employee', 'customers'));
    }

    /**
     * Display a listing of all employees.
     */
    public function index()
    {
        $employees = Employee::paginate(15);
        return view('employees.index', compact('employees'));
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee)
    {
        $customers = $employee->customers()->paginate(15);
        return view('employees.show', compact('employee', 'customers'));
    }
}
