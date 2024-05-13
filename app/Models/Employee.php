<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'phoneNumber'
    ];

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
