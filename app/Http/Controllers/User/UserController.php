<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PayrollPeriod;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Payroll;
use App\Models\Employee;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user/dashboard', compact('user'));
    }

    public function payslipIndex()
    {
        $payrollPeriod = PayrollPeriod::all();
        return view('user/payslip', ['payrollPeriod' => $payrollPeriod]);
    }

    public function viewPayslip($id)
    {
        $user = Auth::user();
        $employeeId = $user->employee_id;

        $payrollSlip = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $employeeId)
            ->whereHas('payrollPeriod', function ($query) use ($id) {
                $query->where('payrollPeriod_id', $id);
            })
            ->get();

        $pdf = PDF::loadView('superadmin.view-payrollslip', array('payrollSlip' =>  $payrollSlip))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Slip_Gaji.pdf');
    }

    public function downloadPayslip($id)
    {
        $user = Auth::user();
        $employeeId = $user->employee_id;

        $payrollSlip = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $employeeId)
            ->whereHas('payrollPeriod', function ($query) use ($id) {
                $query->where('payrollPeriod_id', $id);
            })
            ->get();

        $pdf = PDF::loadView('superadmin.view-payrollslip', array('payrollSlip' =>  $payrollSlip))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Slip Gaji.pdf');
    }

    public function payrollHistoryIndex()
    {
        $payrollPeriod = PayrollPeriod::all();
        return view('user/payroll-history', ['payrollPeriod' => $payrollPeriod]);
    }
}
