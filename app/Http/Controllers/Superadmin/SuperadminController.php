<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class SuperadminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalEmployee = Employee::count();
        return view('superadmin/dashboard', compact('user', 'totalEmployee'));
    }
}
