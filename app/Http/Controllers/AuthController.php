<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function daftar(Request $request)
    {
        $request->validate(['email' => 'unique:daftar_user,email']);

        if (!$request->nama_user || !$request->email || !$request->password){
            return back()->with('error','Data tidak boleh kosong!');
        }
        
        DB::table('daftar_user')->insert([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/indexsudahlog');
    }
}
