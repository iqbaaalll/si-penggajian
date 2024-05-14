<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayrollPeriod;
use App\Models\Payroll;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollsExport;

class PayrollReportAdminController extends Controller
{
    public function payrollReportIndex()
    {
        $payrollPeriod = PayrollPeriod::all();
        return view('admin/payroll-report', ['payrollPeriod' => $payrollPeriod]);
    }

    public function payrollReportDetailIndex($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->where('payrollPeriod_id', $id)
            ->paginate(9);

        return view('admin/payroll-report-detail', ['payrolls' => $payrolls, 'payrollPeriod' => $payrollPeriod]);
    }

    public function exportPayroll($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        if (!$payrollPeriod) {
            return redirect()->back()->withErrors(['payrollMonth' => 'Payroll period not found']);
        }

        $payrollMonth = $payrollPeriod->payrollMonth;

        $formattedMonth = \Carbon\Carbon::parse($payrollMonth)->format('F Y');

        return Excel::download(new PayrollsExport($payrollMonth), 'Data Gaji ' . $formattedMonth . '.xlsx');
    }
}
