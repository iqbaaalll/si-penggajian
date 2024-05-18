<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\User;
use App\Models\PayrollPeriod;
use App\Models\Payroll;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalEmployee = Employee::count();
        $totalUser = User::count();
        $currentPayrollPeriod = PayrollPeriod::where('payrollMonth', now()->format('Y-m'))->firstOrFail();
        $payrollMonthId = $currentPayrollPeriod->id;
        $payrolls = Payroll::where('payrollPeriod_id', $payrollMonthId)->get();
        $totalNetSalary = $payrolls->sum('netSalary');

        return view('admin.dashboard', compact('user', 'totalEmployee', 'totalNetSalary', 'totalUser'));
    }
}
