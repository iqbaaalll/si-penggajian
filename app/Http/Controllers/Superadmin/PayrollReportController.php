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
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\PDF;

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
            ->paginate(7);

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

    public function viewPayrollSlip($id)
    {
        $payrollSlip = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $id)->get();

        $pdf = PDF::loadView('superadmin.view-payrollslip', array('payrollSlip' =>  $payrollSlip))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Slip_Gaji.pdf');
    }

    public function downloadPayrollSlip($id)
    {
        $payrollSlip = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $id)->get();

        $pdf = PDF::loadView('superadmin.view-payrollslip', array('payrollSlip' =>  $payrollSlip))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Slip Gaji.pdf');
    }

    public function sendPayrollSlip($id)
    {
        $payrollSlip = Payroll::with(['employee', 'payrollPeriod'])
            ->where('employee_id', $id)->first();

        $phoneNumber = $this->formatPhoneNumber($payrollSlip->employee->phoneNumber);

        $pdf = PDF::loadView('superadmin.send-payrollslip', ['payrollSlip' => $payrollSlip])
            ->setPaper('a4', 'portrait');

        $filePath = storage_path('app/public/Slip_Gaji.pdf');
        $pdf->save($filePath);

        $this->sendPdfToWablas($filePath, $phoneNumber);

        unlink($filePath);

        return redirect()->back()->with('success', 'Payslip successfully sent');
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        if (strpos($phoneNumber, '0') === 0) {
            return '62' . substr($phoneNumber, 1);
        }
        return $phoneNumber;
    }

    protected function sendPdfToWablas($filePath, $phone)
    {
        $client = new \GuzzleHttp\Client();
        $token = config('services.wablas.token');

        $fileContent = base64_encode(file_get_contents($filePath));

        $response = $client->post('https://jkt.wablas.com/api/send-document-from-local', [
            'headers' => [
                'Authorization' => $token,
            ],
            'form_params' => [
                'phone' => $phone,
                'file' => $fileContent,
                'data' => json_encode(['name' => 'Slip_Gaji.pdf'])
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        if (isset($result['status']) && $result['status'] === 'success') {
            return true;
        } else {
            return false;
        }
    }
}
