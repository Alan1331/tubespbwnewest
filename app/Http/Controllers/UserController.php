<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

    public function show($fileName)
    {
        // Check if the file exists in the storage
        if (Storage::exists('public/storage/uploads/' . $fileName)) {
            // Get the file content
            $fileContent = Storage::get('public/storage/uploads/' . $fileName);

            // Return the image with the correct MIME type
            return response($fileContent)->header('Content-Type', 'image/jpeg');
        }

        return abort(404);
    }

}