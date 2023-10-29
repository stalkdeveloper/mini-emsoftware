<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function dashboradDataDetails(Request $request){
        try {
            $company = Company::count();
            $user = User::count();
            $emp = Employee::count();
            $employee = Employee::orderBy('id', 'desc')->paginate(10, ['*'], 'employee');
            return view('dashboard', compact('company', 'user', 'emp', 'employee'));
        } catch (\Exception $e) {
            // \Log::info($e);
        }
    }
}
