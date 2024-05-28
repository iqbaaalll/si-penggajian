<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PayrollPeriod;
use App\Models\Payroll;
use App\Models\Employee;

class PayrollController extends Controller
{
    public function payrollIndex()
    {
        $payrollPeriod = PayrollPeriod::all();
        return view('superadmin.payroll', ['payrollPeriod' => $payrollPeriod]);
    }

    public function payrollDetailIndex($id)
    {
        $payrollPeriod = PayrollPeriod::find($id);

        $payrolls = Payroll::with(['employee', 'payrollPeriod'])
            ->where('payrollPeriod_id', $id)
            ->paginate(9);

        return view('superadmin/payroll-detail', ['payrolls' => $payrolls, 'payrollPeriod' => $payrollPeriod]);
    }

    public function runPayroll(Request $request)
    {
        $request->validate([
            'payrollMonth' => 'required|date_format:Y-m',
            'payrollSchedule' => 'required|date'
        ]);

        $savePayrollPeriod = PayrollPeriod::create(['payrollMonth' => $request->payrollMonth, 'payrollSchedule' => $request->payrollSchedule]);

        if ($savePayrollPeriod) {
            $employees = Employee::all();
            $payrollPeriod = PayrollPeriod::latest('payrollMonth')->first()->id;

            foreach ($employees as $employee) {
                $withBonus = $request->has('bonus');
                $withThr = $request->has('thr');
                $bonus = 0;
                $thr = 0;

                if ($withBonus == "true") {
                    $bonus = $employee->bonus;
                } else {
                    $bonus = 0;
                }

                if ($withThr == "true") {
                    $thr = $employee->thr;
                } else {
                    $thr = 0;
                }

                $basicSalary = $employee->salaryMonth;
                $brutoSalary = $basicSalary + $bonus + $thr;
                $ptkpStatus = $employee->taxStatus;

                $terStatus = "";

                if ($ptkpStatus == "TK/0" || $ptkpStatus == "TK/1" || $ptkpStatus == "K/0") {
                    $terStatus = "TER A";
                } elseif ($ptkpStatus == "TK/2" || $ptkpStatus == "TK/3" || $ptkpStatus == "K/1" || $ptkpStatus == "K/2") {
                    $terStatus = "TER B";
                } elseif ($ptkpStatus == "K/3") {
                    $terStatus = "TER C";
                }

                $terPercentage = 0;

                if ($terStatus == "TER A") {
                    if ($brutoSalary <= 5400000) {
                    } elseif ($brutoSalary >= 5400001 && $brutoSalary <= 5650000) {
                        $terPercentage = 0.0025;
                    } elseif ($brutoSalary >= 5650001 && $brutoSalary <= 5950000) {
                        $terPercentage = 0.005;
                    } elseif ($brutoSalary >= 5950001 && $brutoSalary <= 6300000) {
                        $terPercentage = 0.0075;
                    } elseif ($brutoSalary >= 6300001 && $brutoSalary <= 6750000) {
                        $terPercentage = 0.01;
                    } elseif ($brutoSalary >= 6750001 && $brutoSalary <= 7500000) {
                        $terPercentage = 0.0125;
                    } elseif ($brutoSalary >= 7500001 && $brutoSalary <= 8550000) {
                        $terPercentage = 0.015;
                    } elseif ($brutoSalary >= 8550001 && $brutoSalary <= 9650000) {
                        $terPercentage = 0.0175;
                    } elseif ($brutoSalary >= 9650001 && $brutoSalary <= 10050000) {
                        $terPercentage = 0.02;
                    } elseif ($brutoSalary >= 10050001 && $brutoSalary <= 10350000) {
                        $terPercentage = 0.0225;
                    } elseif ($brutoSalary >= 10350001 && $brutoSalary <= 10700000) {
                        $terPercentage = 0.025;
                    } elseif ($brutoSalary >= 10700001 && $brutoSalary <= 11050000) {
                        $terPercentage = 0.03;
                    } elseif ($brutoSalary >= 11050001 && $brutoSalary <= 11600000) {
                        $terPercentage = 0.035;
                    } elseif ($brutoSalary >= 11600001 && $brutoSalary <= 12500000) {
                        $terPercentage = 0.04;
                    } elseif ($brutoSalary >= 12500001 && $brutoSalary <= 13750000) {
                        $terPercentage = 0.05;
                    } elseif ($brutoSalary >= 13750001 && $brutoSalary <= 15100000) {
                        $terPercentage = 0.06;
                    } elseif ($brutoSalary >= 15100001 && $brutoSalary <= 16950000) {
                        $terPercentage = 0.07;
                    } elseif ($brutoSalary >= 16950001 && $brutoSalary <= 19750000) {
                        $terPercentage = 0.08;
                    } elseif ($brutoSalary >= 19750001 && $brutoSalary <= 24150000) {
                        $terPercentage = 0.09;
                    } elseif ($brutoSalary >= 24150001 && $brutoSalary <= 26450000) {
                        $terPercentage = 0.10;
                    } elseif ($brutoSalary >= 26450001 && $brutoSalary <= 28000000) {
                        $terPercentage = 0.11;
                    } elseif ($brutoSalary >= 28000001 && $brutoSalary <= 30050000) {
                        $terPercentage = 0.12;
                    } elseif ($brutoSalary >= 30050001 && $brutoSalary <= 32400000) {
                        $terPercentage = 0.13;
                    } elseif ($brutoSalary >= 32400001 && $brutoSalary <= 35400000) {
                        $terPercentage = 0.14;
                    } elseif ($brutoSalary >= 35400001 && $brutoSalary <= 39100000) {
                        $terPercentage = 0.15;
                    } elseif ($brutoSalary >= 39100001 && $brutoSalary <= 43850000) {
                        $terPercentage = 0.16;
                    } elseif ($brutoSalary >= 43850001 && $brutoSalary <= 47800000) {
                        $terPercentage = 0.17;
                    } elseif ($brutoSalary >= 47800001 && $brutoSalary <= 51400000) {
                        $terPercentage = 0.18;
                    } elseif ($brutoSalary >= 51400001 && $brutoSalary <= 56300000) {
                        $terPercentage = 0.19;
                    } elseif ($brutoSalary >= 56300001 && $brutoSalary <= 62200000) {
                        $terPercentage = 0.20;
                    } elseif ($brutoSalary >= 62200001 && $brutoSalary <= 68600000) {
                        $terPercentage = 0.21;
                    } elseif ($brutoSalary >= 68600001 && $brutoSalary <= 77500000) {
                        $terPercentage = 0.22;
                    } elseif ($brutoSalary >= 77500001 && $brutoSalary <= 89000000) {
                        $terPercentage = 0.23;
                    }
                } elseif ($terStatus == "TER B") {
                    if ($brutoSalary <= 6200000) {
                        $terPercentage = 0;
                    } elseif ($brutoSalary >= 6200001 && $brutoSalary <= 6500000) {
                        $terPercentage = 0.0025;
                    } elseif ($brutoSalary >= 6500001 && $brutoSalary <= 6850000) {
                        $terPercentage = 0.005;
                    } elseif ($brutoSalary >= 6850001 && $brutoSalary <= 7300000) {
                        $terPercentage = 0.0075;
                    } elseif ($brutoSalary >= 7300001 && $brutoSalary <= 9200000) {
                        $terPercentage = 0.01;
                    } elseif ($brutoSalary >= 9200001 && $brutoSalary <= 10750000) {
                        $terPercentage = 0.015;
                    } elseif ($brutoSalary >= 10750001 && $brutoSalary <= 11250000) {
                        $terPercentage = 0.02;
                    } elseif ($brutoSalary >= 11250001 && $brutoSalary <= 11600000) {
                        $terPercentage = 0.025;
                    } elseif ($brutoSalary >= 11600001 && $brutoSalary <= 12600000) {
                        $terPercentage = 0.03;
                    } elseif ($brutoSalary >= 12600001 && $brutoSalary <= 13600000) {
                        $terPercentage = 0.04;
                    } elseif ($brutoSalary >= 13600001 && $brutoSalary <= 14950000) {
                        $terPercentage = 0.05;
                    } elseif ($brutoSalary >= 14950001 && $brutoSalary <= 16400000) {
                        $terPercentage = 0.06;
                    } elseif ($brutoSalary >= 16400001 && $brutoSalary <= 18450000) {
                        $terPercentage = 0.07;
                    } elseif ($brutoSalary >= 18450001 && $brutoSalary <= 21850000) {
                        $terPercentage = 0.08;
                    } elseif ($brutoSalary >= 21850001 && $brutoSalary <= 26000000) {
                        $terPercentage = 0.09;
                    } elseif ($brutoSalary >= 26000001 && $brutoSalary <= 27700000) {
                        $terPercentage = 0.10;
                    } elseif ($brutoSalary >= 27700001 && $brutoSalary <= 29350000) {
                        $terPercentage = 0.11;
                    } elseif ($brutoSalary >= 29350001 && $brutoSalary <= 31450000) {
                        $terPercentage = 0.12;
                    } elseif ($brutoSalary >= 31450001 && $brutoSalary <= 33950000) {
                        $terPercentage = 0.13;
                    } elseif ($brutoSalary >= 33950001 && $brutoSalary <= 37100000) {
                        $terPercentage = 0.14;
                    } elseif ($brutoSalary >= 37100001 && $brutoSalary <= 41100000) {
                        $terPercentage = 0.15;
                    } elseif ($brutoSalary >= 41100001 && $brutoSalary <= 45800000) {
                        $terPercentage = 0.16;
                    } elseif ($brutoSalary >= 45800001 && $brutoSalary <= 49500000) {
                        $terPercentage = 0.17;
                    } elseif ($brutoSalary >= 49500001 && $brutoSalary <= 53800000) {
                        $terPercentage = 0.18;
                    } elseif ($brutoSalary >= 53800001 && $brutoSalary <= 58500000) {
                        $terPercentage = 0.19;
                    } elseif ($brutoSalary >= 58500000 && $brutoSalary <= 64000000) {
                        $terPercentage = 0.20;
                    } elseif ($brutoSalary >= 64000001 && $brutoSalary <= 71000000) {
                        $terPercentage = 0.21;
                    } elseif ($brutoSalary >= 71000001 && $brutoSalary <= 80000000) {
                        $terPercentage = 0.22;
                    } elseif ($brutoSalary >= 80000001 && $brutoSalary <= 93000000) {
                        $terPercentage = 0.23;
                    }
                } elseif ($terStatus == "TER C") {
                    if ($brutoSalary <= 6600000) {
                        $terPercentage = 0;
                    } elseif ($brutoSalary >= 6600001 && $brutoSalary <= 6950000) {
                        $terPercentage = 0.0025;
                    } elseif ($brutoSalary >= 6950001 && $brutoSalary <= 7350000) {
                        $terPercentage = 0.005;
                    } elseif ($brutoSalary >= 7350001 && $brutoSalary <= 7800000) {
                        $terPercentage = 0.0075;
                    } elseif ($brutoSalary >= 7800001 && $brutoSalary <= 8850000) {
                        $terPercentage = 0.01;
                    } elseif ($brutoSalary >= 8850001 && $brutoSalary <= 9800000) {
                        $terPercentage = 0.0125;
                    } elseif ($brutoSalary >= 9800001 && $brutoSalary <= 10950000) {
                        $terPercentage = 0.015;
                    } elseif ($brutoSalary >= 10950001 && $brutoSalary <= 11200000) {
                        $terPercentage = 0.0175;
                    } elseif ($brutoSalary >= 11200001 && $brutoSalary <= 12050000) {
                        $terPercentage = 0.02;
                    } elseif ($brutoSalary >= 12050001 && $brutoSalary <= 12950000) {
                        $terPercentage = 0.03;
                    } elseif ($brutoSalary >= 12950001 && $brutoSalary <= 14150000) {
                        $terPercentage = 0.04;
                    } elseif ($brutoSalary >= 14150001 && $brutoSalary <= 15550000) {
                        $terPercentage = 0.05;
                    } elseif ($brutoSalary >= 15550001 && $brutoSalary <= 17050000) {
                        $terPercentage = 0.06;
                    } elseif ($brutoSalary >= 17050001 && $brutoSalary <= 19500000) {
                        $terPercentage = 0.07;
                    } elseif ($brutoSalary >= 19500001 && $brutoSalary <= 22700000) {
                        $terPercentage = 0.08;
                    } elseif ($brutoSalary >= 22700001 && $brutoSalary <= 26600000) {
                        $terPercentage = 0.09;
                    } elseif ($brutoSalary >= 26600001 && $brutoSalary <= 28100000) {
                        $terPercentage = 0.10;
                    } elseif ($brutoSalary >= 28100001 && $brutoSalary <= 30100000) {
                        $terPercentage = 0.11;
                    } elseif ($brutoSalary >= 30100001 && $brutoSalary <= 32600000) {
                        $terPercentage = 0.12;
                    } elseif ($brutoSalary >= 32600001 && $brutoSalary <= 35400000) {
                        $terPercentage = 0.13;
                    } elseif ($brutoSalary >= 35400001 && $brutoSalary <= 38900000) {
                        $terPercentage = 0.14;
                    } elseif ($brutoSalary >= 38900001 && $brutoSalary <= 43000000) {
                        $terPercentage = 0.15;
                    } elseif ($brutoSalary >= 43000001 && $brutoSalary <= 47400000) {
                        $terPercentage = 0.16;
                    } elseif ($brutoSalary >= 47400001 && $brutoSalary <= 51200000) {
                        $terPercentage = 0.17;
                    } elseif ($brutoSalary >= 51200001 && $brutoSalary <= 55800000) {
                        $terPercentage = 0.18;
                    } elseif ($brutoSalary >= 55800001 && $brutoSalary <= 60400000) {
                        $terPercentage = 0.19;
                    } elseif ($brutoSalary >= 60400001 && $brutoSalary <= 66700000) {
                        $terPercentage = 0.20;
                    } elseif ($brutoSalary >= 66700001 && $brutoSalary <= 74500000) {
                        $terPercentage = 0.21;
                    } elseif ($brutoSalary >= 74500001 && $brutoSalary <= 83200000) {
                        $terPercentage = 0.22;
                    } elseif ($brutoSalary >= 83200001 && $brutoSalary <= 95000000) {
                        $terPercentage = 0.23;
                    }
                }

                $taxAmount = ($brutoSalary * $terPercentage);

                $bpjsKesAmount = 0;

                $bpjsKesCalculate = ($brutoSalary * 0.01);

                if ($bpjsKesCalculate <= 120000) {
                    $bpjsKesAmount = $bpjsKesCalculate;
                } elseif ($bpjsKesCalculate > 120000) {
                    $bpjsKesAmount = 120000;
                }

                $bpjsTkAmount = ($brutoSalary * 0.02);

                $pensionAmount = 0;

                if ($bpjsKesAmount <= 100000) {
                    $pensionAmount = $bpjsKesAmount;
                } elseif ($bpjsKesAmount > 100000) {
                    $pensionAmount = 100423;
                }

                $netSalary = (($basicSalary + $bonus + $thr) - $taxAmount - $bpjsKesAmount - $bpjsTkAmount - $pensionAmount);

                Payroll::create([
                    'payrollPeriod_id' => $payrollPeriod,
                    'employee_id' => $employee->id,
                    'basicSalary' => $basicSalary,
                    'bonus' => $bonus,
                    'thr' => $thr,
                    'brutoSalary' => $brutoSalary,
                    'taxAmount' => $taxAmount,
                    'bpjsKesAmount' => $bpjsKesAmount,
                    'bpjsTkAmount' => $bpjsTkAmount,
                    'pensionAmount' => $pensionAmount,
                    'netSalary' => $netSalary
                ]);
            }
            return redirect()->route('superadmin.payroll')->with('success', 'Success to run payroll');
        } else {
            return back()->with('error', 'Failed to run payroll');
        }
    }

    public function editPayrollIndex($id) {
        $payroll = Payroll::with('employee', 'payrollPeriod')
            ->where('employee_id', $id)->first();

        return view('superadmin/edit-payroll', compact('payroll'));
    }

    public function editPayroll(Request $request, $id)
    {
        $payroll = Payroll::with('employee')
            ->where('employee_id', $id)->first();

        $request->validate([
            'pensionAmount' => 'required|integer|min:0',
            'debtAmount' => 'required|integer|min:0'
        ]);

        $pensionAmount = $request->pensionAmount;
        $debtAmount = $request->debtAmount;

        $basicSalary = $payroll->basicSalary;
        $bonus = $payroll->bonus;
        $thr = $payroll->thr;
        $taxAmount = $payroll->taxAmount;
        $bpjsKesAmount = $payroll->bpjsKesAmount;
        $bpjsTkAmount = $payroll->bpjsTkAmount;
        $netSalaryNow = ($basicSalary + $bonus + $thr) - $taxAmount - $bpjsKesAmount - $bpjsTkAmount - $pensionAmount - $debtAmount;

        $payroll->update([
            'pensionAmount' => $pensionAmount,
            'debtAmount' => $debtAmount,
            'netSalary' => $netSalaryNow
        ]);

        return redirect()->back()->with('success', 'Payroll updated successfully');
    }
}
