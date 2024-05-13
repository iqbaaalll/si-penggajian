<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Superadmin\EmployeeController;
use App\Http\Controllers\Superadmin\UserManagementController;
use App\Http\Controllers\Superadmin\PayrollController;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// USER ROUTES
Route::prefix('user')->middleware(['auth', 'userMiddleware', 'preventBackAfterLogout'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// ADMIN ROUTES
Route::middleware(['auth', 'adminMiddleware', 'preventBackAfterLogout'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// SUPERADMIN ROUTES
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
    });

    Route::prefix('user-management')->group(function () {
        Route::get('', [UserManagementController::class, 'userManagementIndex'])->name('superadmin.userManagement');
        Route::post('/add-user', [UserManagementController::class, 'storeUser'])->name('superadmin.addUser');
        Route::delete('/delete-user/{id}', [UserManagementController::class, 'deleteUser'])->name('superadmin.userDelete');
    });

    Route::prefix('payroll')->group(function () {
        Route::get('', [PayrollController::class, 'payrollIndex'])->name('superadmin.payroll');
        Route::post('/run-payroll', [PayrollController::class, 'runPayroll'])->name('superadmin.runPayroll');
        Route::get('/payroll-details/{id}', [PayrollController::class, 'payrollDetailIndex'])->name('superadmin.payrollDetails');
    });
});
