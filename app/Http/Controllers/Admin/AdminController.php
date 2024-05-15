<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalEmployee = Employee::count();
        return view('admin/dashboard', compact('user', 'totalEmployee'));
    }
}
