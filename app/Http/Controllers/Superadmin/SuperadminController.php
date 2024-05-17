<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollPeriod;

class SuperadminController extends Controller
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

        return view('superadmin.dashboard', compact('user', 'totalEmployee', 'totalNetSalary', 'totalUser'));
    }
}
