<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Models\Employee;

class UserManagementController extends Controller
{
    public function userManagementIndex()
    {
        $users = $this->getAllUsers()->original;
        return view('superadmin/user-management', ['users' => $users]);
    }

    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $employee = Employee::where('name', $request->name)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'employee_id' => $employee ? $employee->id : null,
        ]);

        event(new Registered($user));

        session()->flash('success', 'New user added successfully.');

        if (Auth::user()->role == 'superadmin') {
            return redirect()->route('superadmin.userManagement');
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted.');
    }
}
