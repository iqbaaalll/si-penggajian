<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PayrollPeriod;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Payroll;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employeeId = $user->employee_id;
        $currentMonth = Carbon::now()->format('Y-m');
        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $employeeId)
            ->whereHas('payrollPeriod', function ($query) use ($currentMonth) {
                $query->where('payrollMonth', $currentMonth);
            })
            ->get();

        $dateNow = Carbon::now()->format('F Y');
        $netSalary = $payrolls->first()->netSalary;
        $taxAmount = $payrolls->first()->taxAmount;
        $debtAmount = $payrolls->first()->debtAmount;
        return view('user/dashboard', compact('dateNow', 'netSalary', 'taxAmount', 'debtAmount', 'user'));
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

    public function payrollHistoryDetail($id)
    {
        $user = Auth::user();
        $employeeId = $user->employee_id;
        $decryptId = Crypt::decryptString($id);
        $payrollHistory = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $employeeId)
            ->whereHas('payrollPeriod', function ($query) use ($decryptId) {
                $query->where('payrollPeriod_id', $decryptId);
            })
            ->get();

        return view('user/payroll-history-detail', ['payrollHistory' => $payrollHistory]);
    }
}
