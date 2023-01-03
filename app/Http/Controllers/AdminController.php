<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\User;
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

    public function edit_product(Request $request, $id){
        $barang = Barang::where('id', $id)->first();
        return view('admin.product-edit', compact('barang'));
    }

    public function update_barang(Request $request, $id){
        $barang = Barang::findOrFail($id);
        $barang->harga = $request->input('harga');
        $barang->stok = $request->input('stok');
        $barang->keterangan = $request->input('keterangan');
        $barang->save();

    	Alert::success('Barang Sukses diupdate', 'Success');
    	return redirect('admin-dashboard');
    }
}
