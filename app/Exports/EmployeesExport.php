<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'initialName',
            'startWork',
            'birth',
            'salaryMonth',
            'bonus',
            'thr',
            'bankAccount',
            'taxStatus',
            'nip',
            'nik',
            'npwp',
            'bpjsKes',
            'bpjsTk',
            'phoneNumber',
            'created_at',
            'updated_at',
        ];
    }
}
