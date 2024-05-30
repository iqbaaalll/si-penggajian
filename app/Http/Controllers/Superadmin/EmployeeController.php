<?php

namespace App\Http\Controllers\Superadmin;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function employeeIndex()
    {
        $employees = Employee::paginate(7);
        return view('superadmin.employee', ['employees' => $employees]);
    }

    public function addEmployeeIndex()
    {
        return view('superadmin/add-employee');
    }

    public function getAllEmployees()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'initialName' => ['required', 'string', 'max:5'],
            'startWork' => ['required', 'date'],
            'birth' => ['required', 'date'],
            'salaryMonth' => ['required', 'integer'],
            'bonus' => ['integer'],
            'thr' => ['integer'],
            'bankAccount' => ['required', 'string', 'max:12'],
            'taxStatus' => ['required', 'string', 'max:5'],
            'nip' => ['required', 'string', 'max:12'],
            'nik' => ['required', 'string', 'max:18'],
            'npwp' => ['required', 'string', 'max:18'],
            'bpjsKes' => ['required', 'string', 'max:15'],
            'bpjsTk' => ['required', 'string', 'max:13'],
            'phoneNumber' => ['required', 'string', 'max:13']
        ]);

        Employee::create([
            'name' => $request->name,
            'initialName' => $request->initialName,
            'startWork' => $request->startWork,
            'birth' => $request->birth,
            'salaryMonth' => $request->salaryMonth,
            'bonus' => $request->bonus,
            'thr' => $request->thr,
            'bankAccount' => $request->bankAccount,
            'taxStatus' => $request->taxStatus,
            'nip' => $request->nip,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'bpjsKes' => $request->bpjsKes,
            'bpjsTk' => $request->bpjsTk,
            'phoneNumber' => $request->phoneNumber
        ]);

        if (Auth::user()->role == 'superadmin') {
            return redirect()->route('superadmin.employee')->with('success', 'Employee added successfully');
        }
    }

    public function deleteEmployee($id)
    {
        $decryptId = Crypt::decryptString($id);

        $employee = Employee::findOrFail($decryptId);
        $employee->delete();

        return redirect()->back()->with('success', 'Employee has been deleted.');
    }

    public function viewEmployee($id)
    {
        $decryptId = Crypt::decryptString($id);

        $employee = Employee::find($decryptId);

        if (!$employee) {
            abort(404);
        }

        return view('superadmin/view-employee', compact('employee'));
    }

    public function editEmployeeIndex($id)
    {
        $decryptId = Crypt::decryptString($id);

        $employee = Employee::find($decryptId);

        if (!$employee) {
            abort(404);
        }

        return view('superadmin/edit-employee', compact('employee'));
    }

    public function editEmployee(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);

        $employee = Employee::find($decryptId);

        if (!$employee) {
            abort(404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'initialName' => 'required|string|max:5',
            'startWork' => 'required|date',
            'birth' => 'required|date',
            'salaryMonth' => 'required|integer',
            'bonus' => 'required|integer',
            'thr' => 'required|integer',
            'bankAccount' => 'required|string|max:12',
            'taxStatus' => 'required|string|max:5',
            'nip' => 'required|string|max:12',
            'nik' => 'required|string|max:18',
            'npwp' => 'required|string|max:18',
            'bpjsKes' => 'required|string|max:15',
            'bpjsTk' => 'required|string|max:13',
            'phoneNumber' => 'required|string|max:13',
        ]);

        $employee->update($validatedData);

        return redirect()->route('superadmin.viewEmployee', $id)->with('success', 'Employee updated successfully');
    }

    public function exportEmployee()
    {
        return Excel::download(new EmployeesExport, 'Daftar Karyawan BCP.xlsx');
    }
}
