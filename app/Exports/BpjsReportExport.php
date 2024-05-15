<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BpjsReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $payrollMonth;
    protected $totalBpjsKes;
    protected $totalBpjsTk;
    protected $totalPensionDeduction;

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

        $this->totalBpjsKes = $payrolls->sum('bpjsKesAmount');
        $this->totalBpjsTk = $payrolls->sum('bpjsTkAmount');
        $this->totalPensionDeduction = $payrolls->sum('pensionAmount');

        return $payrolls;
    }

    public function headings(): array
    {
        return [
            'Payroll Month',
            'Name',
            'BPJS Kesehatan',
            'BPJS Ketenagakerjaan',
            'Pension Deduction'
        ];
    }

    public function map($payroll): array
    {
        return [
            \Carbon\Carbon::parse($payroll->payrollPeriod->payrollMonth)->format('F Y'),
            $payroll->employee->name,
            $payroll->bpjsKesAmount,
            $payroll->bpjsTkAmount,
            $payroll->pensionAmount
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:E1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

                $lastRow = $event->sheet->getHighestRow() + 1;

                $event->sheet->setCellValue('A' . $lastRow, 'Total');
                $event->sheet->setCellValue('C' . $lastRow, $this->totalBpjsKes);
                $event->sheet->setCellValue('D' . $lastRow, $this->totalBpjsTk);
                $event->sheet->setCellValue('E' . $lastRow, $this->totalPensionDeduction);

                $event->sheet->getDelegate()->getStyle('A' . $lastRow . ':E' . $lastRow)->getFont()->setBold(true);
            },
        ];
    }
}
