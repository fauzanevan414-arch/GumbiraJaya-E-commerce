<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function daftar(Request $request)
    {
        $request->validate(['email' => 'unique:daftar_user,email']);

        if (!$request->nama_user || !$request->email || !$request->password) {
            return back()->with('error', 'Data tidak boleh kosong!');
        }

        DB::table('daftar_user')->insert([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/indexsudahlog');
    }

    public function login(Request $request){
    // validasi
    if (!$request->email || !$request->password) {
        return back()->with('error', 'Email dan Password tidak boleh kosong.');
    }

    // proses login
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        // ini penting biar session aman
        $request->session()->regenerate();

        return redirect()->route('indexsudahlog');
    }

    return back()->with('error', 'Email atau Password salah.');
}

    public function profile()
    {
        return view('profile');
    }

    public function logout(Request $request)
    {
        session()->flush(); // Hapus semua session
        return redirect('');
    }
}
