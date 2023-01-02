<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AdminController extends Controller
{
    public function login_form() {
        return view('admin_auth.login');
    }

    public function login_store(Request $request) {
        // dd($request->all());

        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password'] ])) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin Login Successfully');
        } else {
            return back();
        }
    }

    public function index()
    {
        $barangs = DB::table('barangs')->simplePaginate(10);
        return view('admin-dashboard', ['barangs' => $barangs]);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form')->with('error', 'Admin Logout Successfully');
    }
}
