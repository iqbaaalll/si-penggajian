<?php

namespace App\Http\Controllers\superadmin;

use App\Exports\BpjsReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayrollPeriod;
use App\Models\Payroll;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollsExport;
use App\Exports\TaxReportExport;
use App\Exports\TransferListsExport;

class PayrollReportController extends Controller
{
    public function payrollReportIndex()
    {
        $payrollPeriod = PayrollPeriod::all();
        return view('superadmin/payroll-report', ['payrollPeriod' => $payrollPeriod]);
    }

    public function payrollReportDetailIndex($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->where('payrollPeriod_id', $id)
            ->paginate(9);

        return view('superadmin/payroll-report-detail', ['payrolls' => $payrolls, 'payrollPeriod' => $payrollPeriod]);
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

    public function otherReportIndex($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->where('payrollPeriod_id', $id)->get();

        $totalNetSalary = $payrolls->sum('netSalary');
        $totalTaxDeduction = $payrolls->sum('taxAmount');
        $totalBpjsKes = $payrolls->sum('bpjsKesAmount');
        $totalBpjsTk = $payrolls->sum('bpjsTkAmount');
        $totalPensionDeduction = $payrolls->sum('pensionAmount');

        return view('superadmin/other-report', [
            'payrolls' => $payrolls,
            'payrollPeriod' => $payrollPeriod,
            'totalNetSalary' => $totalNetSalary,
            'totalTaxDeduction' => $totalTaxDeduction,
            'totalBpjsKes' => $totalBpjsKes,
            'totalBpjsTk' => $totalBpjsTk,
            'totalPensionDeduction' => $totalPensionDeduction
        ]);
    }

    public function exportTransferlist($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        if (!$payrollPeriod) {
            return redirect()->back()->withErrors(['payrollMonth' => 'Payroll period not found']);
        }

        $payrollMonth = $payrollPeriod->payrollMonth;

        return Excel::download(new TransferListsExport($payrollMonth), 'Data Transfer ' . \Carbon\Carbon::parse($payrollMonth)->format('F Y') . '.xlsx');
    }

    public function exportTaxReport($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        if (!$payrollPeriod) {
            return redirect()->back()->withErrors(['payrollMonth' => 'Payroll period not found']);
        }

        $payrollMonth = $payrollPeriod->payrollMonth;

        return Excel::download(new TaxReportExport($payrollMonth), 'Data Potongan Pajak ' . \Carbon\Carbon::parse($payrollMonth)->format('F Y') . '.xlsx');
    }

    public function exportBpjsReport($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        if (!$payrollPeriod) {
            return redirect()->back()->withErrors(['payrollMonth' => 'Payroll period not found']);
        }

        $payrollMonth = $payrollPeriod->payrollMonth;

        return Excel::download(new BpjsReportExport($payrollMonth), 'Data Potongan BPJS ' . \Carbon\Carbon::parse($payrollMonth)->format('F Y') . '.xlsx');
    }
}
