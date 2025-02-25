<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Superadmin\EmployeeController;
use App\Http\Controllers\Superadmin\UserManagementController;
use App\Http\Controllers\Superadmin\PayrollController;
use App\Http\Controllers\superadmin\PayrollReportController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeAdminController;
use App\Http\Controllers\Admin\PayrollReportAdminController;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/// USER ROUTES ///
Route::prefix('user')->middleware(['auth', 'userMiddleware', 'preventBackAfterLogout'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::prefix('payslip')->group(function () {
        Route::get('', [UserController::class, 'payslipIndex'])->name('user.payslip');
        Route::get('/pdf/{id}', [UserController::class, 'viewPayslip'])->name('user.viewPayslip');
        Route::get('/pdf-download/{id}', [UserController::class, 'downloadPayslip'])->name('user.downloadPayslip');
    });

    Route::prefix('payroll-history')->group(function () {
        Route::get('', [UserController::class, 'payrollHistoryIndex'])->name('user.payrollHistory');
        Route::get('/history-detail/{id}', [UserController::class, 'payrollHistoryDetail'])->name('user.payrollHistoryDetail');
    });
});

/// ADMIN ROUTES //
Route::prefix('admin')->middleware(['auth', 'adminMiddleware', 'preventBackAfterLogout'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('employee')->group(function () {
        Route::get('', [EmployeeAdminController::class, 'employeeIndex'])->name('admin.employee');
        Route::get('/view-employee/{id}', [EmployeeAdminController::class, 'viewEmployee'])->name('admin.viewEmployee');
        Route::get('/export/employee', [EmployeeAdminController::class, 'exportEmployee'])->name('admin.exportEmployee');
    });

    Route::prefix('report-payroll')->group(function () {
        Route::get('', [PayrollReportAdminController::class, 'payrollReportIndex'])->name('admin.payrollReport');
        Route::get('/report-details/{id}', [PayrollReportAdminController::class, 'payrollReportDetailIndex'])->name('admin.payrollReportDetails');
        Route::get('/export/payroll/{id}', [PayrollReportAdminController::class, 'exportPayroll'])->name('admin.exportPayroll');
        Route::get('/report-details/other-report/{id}', [PayrollReportAdminController::class, 'otherReportIndex'])->name('admin.otherReport');
        Route::get('/report-details/other-report/export/transfer/{id}', [PayrollReportAdminController::class, 'exportTransferlist'])->name('admin.exportTransferList');
        Route::get('/report-details/other-report/export/tax/{id}', [PayrollReportAdminController::class, 'exportTaxReport'])->name('admin.exportTaxReport');
        Route::get('/report-details/other-report/export/bpjs/{id}', [PayrollReportAdminController::class, 'exportBpjsReport'])->name('admin.exportBpjsReport');
    });
});

/// SUPERADMIN ROUTES ///
Route::prefix('superadmin')->middleware(['auth', 'superadminMiddleware', 'preventBackAfterLogout'])->group(function () {
    Route::get('/dashboard', [SuperadminController::class, 'index'])->name('superadmin.dashboard');

    Route::prefix('employee')->group(function () {
        Route::get('', [EmployeeController::class, 'employeeIndex'])->name('superadmin.employee');
        Route::get('/add-employee', [EmployeeController::class, 'addEmployeeIndex'])->name('superadmin.addEmployee');
        Route::post('/add-employee', [EmployeeController::class, 'storeEmployee'])->name('superadmin.storeEmployee');
        Route::delete('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('superadmin.employeeDelete');
        Route::get('/view-employee/{id}', [EmployeeController::class, 'viewEmployee'])->name('superadmin.viewEmployee');
        Route::get('/edit-employee/{id}', [EmployeeController::class, 'editEmployeeIndex'])->name('superadmin.editEmployee');
        Route::put('/edit-employee/{id}', [EmployeeController::class, 'editEmployee'])->name('superadmin.updateEmployee');
        Route::get('/export/employee', [EmployeeController::class, 'exportEmployee'])->name('superadmin.exportEmployee');
    });

    Route::prefix('payroll')->group(function () {
        Route::get('', [PayrollController::class, 'payrollIndex'])->name('superadmin.payroll');
        Route::post('/run-payroll', [PayrollController::class, 'runPayroll'])->name('superadmin.runPayroll');
        Route::get('/payroll-details/{id}', [PayrollController::class, 'payrollDetailIndex'])->name('superadmin.payrollDetails');
        Route::get('/edit-payroll/{id}', [PayrollController::class, 'editPayrollIndex'])->name('superadmin.editPayroll');
        Route::put('/edit-payroll/{id}', [PayrollController::class, 'editPayroll'])->name('superadmin.updatePayroll');
    });

    Route::prefix('report-payroll')->group(function () {
        Route::get('', [PayrollReportController::class, 'payrollReportIndex'])->name('superadmin.payrollReport');
        Route::get('/report-details/{id}', [PayrollReportController::class, 'payrollReportDetailIndex'])->name('superadmin.payrollReportDetails');
        Route::get('/report-details/pdf/{id}', [PayrollReportController::class, 'viewPayrollSlip'])->name('superadmin.viewPayrollSlip');
        Route::get('/report-details/pdf-download/{id}', [PayrollReportController::class, 'downloadPayrollSlip'])->name('superadmin.downloadPayrollSlip');
        Route::post('/report-details/pdf-sent/{id}', [PayrollReportController::class, 'sendPayrollSlip'])->name('superadmin.sendPayrollSlip');
        Route::get('/export/payroll/{id}', [PayrollReportController::class, 'exportPayroll'])->name('superadmin.exportPayroll');
        Route::get('/report-details/other-report/{id}', [PayrollReportController::class, 'otherReportIndex'])->name('superadmin.otherReport');
        Route::get('/report-details/other-report/export/transfer/{id}', [PayrollReportController::class, 'exportTransferlist'])->name('superadmin.exportTransferList');
        Route::get('/report-details/other-report/export/tax/{id}', [PayrollReportController::class, 'exportTaxReport'])->name('superadmin.exportTaxReport');
        Route::get('/report-details/other-report/export/bpjs/{id}', [PayrollReportController::class, 'exportBpjsReport'])->name('superadmin.exportBpjsReport');
    });

    Route::prefix('user-management')->group(function () {
        Route::get('', [UserManagementController::class, 'userManagementIndex'])->name('superadmin.userManagement');
        Route::post('/add-user', [UserManagementController::class, 'storeUser'])->name('superadmin.addUser');
        Route::delete('/delete-user/{id}', [UserManagementController::class, 'deleteUser'])->name('superadmin.userDelete');
    });
});
