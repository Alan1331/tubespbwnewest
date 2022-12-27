<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{

 public function index()
    {
        $barangs = DB::table('barangs')->simplePaginate(10);
        return view('dashboard', ['barangs' => $barangs]);
    }

}