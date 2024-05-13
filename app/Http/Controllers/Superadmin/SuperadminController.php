<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('superadmin/dashboard', compact('user'));
    }
}
