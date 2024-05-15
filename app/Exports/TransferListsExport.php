<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransferListsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $payrollMonth;
    protected $totalNetSalary;

    public function __construct($payrollMonth)
    {
        $this->payrollMonth = $payrollMonth;
    }

    public function collection()
    {
        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->whereHas('payrollPeriod', function ($query) {
                $query->where('payrollMonth', $this->payrollMonth);
            })
            ->get();

        $this->totalNetSalary = $payrolls->sum('netSalary');

        return $payrolls;
    }

    public function headings(): array
    {
        return [
            'Payroll Month',
            'Name',
            'Bank Account',
            'Take Home Pay',
        ];
    }

    public function map($payroll): array
    {
        return [
            \Carbon\Carbon::parse($payroll->payrollPeriod->payrollMonth)->format('F Y'),
            $payroll->employee->name,
            $payroll->employee->bankAccount,
            $payroll->netSalary,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:D1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

                $lastRow = $event->sheet->getHighestRow() + 1;

                $event->sheet->setCellValue('A' . $lastRow, 'Total');
                $event->sheet->setCellValue('D' . $lastRow, $this->totalNetSalary);

                $event->sheet->getDelegate()->getStyle('A' . $lastRow . ':D' . $lastRow)->getFont()->setBold(true);
            },
        ];
    }
}
