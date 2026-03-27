<?php

namespace App\Http\Controllers;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function keranjang()
{
    if (!session('id_user')) {
        return redirect('/login');
    }

    $keranjang = Keranjang::where('id_user', session('id_user'))
        ->with('produk')
        ->get();

    return view('keranjang', compact('keranjang'));
}
}
