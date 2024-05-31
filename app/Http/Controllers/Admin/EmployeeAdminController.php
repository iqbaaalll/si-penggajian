<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Crypt;

class EmployeeAdminController extends Controller
{
    public function employeeIndex()
    {
        $employees = Employee::paginate(7);
        return view('admin.employee', ['employees' => $employees]);
    }

    public function viewEmployee($id)
    {
        $decryptId = Crypt::decryptString($id);

        $employee = Employee::find($decryptId);

        if (!$employee) {
            abort(404);
        }

        return view('admin/view-employee', compact('employee'));
    }

    public function exportEmployee()
    {
        return Excel::download(new EmployeesExport, 'Daftar Karyawan BCP.xlsx');
    }
}
