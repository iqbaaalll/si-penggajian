<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'basicSalary',
        'bonus',
        'thr',
        'brutoSalary',
        'taxAmount',
        'bpjsKesAmount',
        'bpjsTkAmount',
        'pensionAmount',
        'netSalary',
        'payrollPeriod_id',
        'employee_id'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function payrollPeriod(): BelongsTo
    {
        return $this->belongsTo(PayrollPeriod::class, 'payrollPeriod_id');
    }
}
