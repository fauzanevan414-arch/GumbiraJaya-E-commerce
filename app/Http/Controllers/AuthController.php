<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function login(Request $request)
    {
        if (!$request->email || !$request->password){
            return back()->with('Error', 'Email dan Password tidak boleh kosong.');
        }
        $user = DB::table('daftar_user')->where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('Error ', 'Email atau Password salah.');
        }
        session([
            'nama_user' => $user->nama_user,
            'email'     => $user->email,
        ]);
        return redirect('/indexsudahlog');
    }
}
