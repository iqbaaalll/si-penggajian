<?php

namespace App\Exports;

use App\Models\Payroll;
use App\Models\PayrollPeriod;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PayrollsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $payrollMonth;

    public function __construct($payrollMonth)
    {
        $this->payrollMonth = $payrollMonth;
    }
    public function collection()
    {
        return Payroll::with(['employee', 'payrollPeriod'])
            ->whereHas('payrollPeriod', function ($query) {
                $query->where('payrollMonth', $this->payrollMonth);
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            'Payroll Month',
            'Name',
            'Tax Staus',
            'Salary per Month',
            'Bonus',
            'THR',
            'Bruto Salary',
            'Tax Amount',
            'BPJS Kesehatan',
            'BPJS Ketenagakerjaan',
            'Pension Amount',
            'Take Home Pay',
        ];
    }

    public function map($payroll): array
    {
        return [
            \Carbon\Carbon::parse($payroll->payrollPeriod->payrollMonth)->format('F Y'),
            $payroll->employee->name,
            $payroll->employee->taxStatus,
            $payroll->basicSalary,
            $payroll->bonus,
            $payroll->thr,
            $payroll->brutoSalary,
            $payroll->taxAmount,
            $payroll->bpjsKesAmount,
            $payroll->bpjsTkAmount,
            $payroll->pensionAmount,
            $payroll->netSalary,
        ];
    }
}
