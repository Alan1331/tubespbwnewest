<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use App\Models\Admin;
use Alert;
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

    public function update_barang(Request $request){
        $barang = Barang::findOrFail($request->input('id'));
        $barang->harga = AdminController::convertToInt($request->input('harga'));
        $barang->stok = AdminController::convertToInt($request->input('stok'));
        $barang->keterangan = $request->input('keterangan');
        $barang->save();

    	Alert::success('Barang Sukses diupdate', 'Success');
    	return redirect()->route('admin.dashboard');
    }

    public function convertToInt($string) {
        // Remove the commas from the string
        $string = str_replace(',', '', $string);
        // Convert the string to an integer and return the result
        return intval($string);
    }

    public function incoming_order(){
        $pesanans = Pesanan::where('status', '!=',0)->get();

    	// return view('history.index', compact('pesanans'));
     	return view('admin.incoming-order', compact('pesanans'));
    }

    public function order_detail($id)
    {
    	$pesanan = Pesanan::where('id', $id)->first();
    	$pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

     	return view('admin.order-detail', compact('pesanan','pesanan_details'));
    }

    public function add_product()
    {
    	$pesanan = Pesanan::where('id', $id)->first();
    	$pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

     	return view('admin.order-detail', compact('pesanan','pesanan_details'));
    }
}
