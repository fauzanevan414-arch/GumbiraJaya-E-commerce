<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request){
    $keyword = $request->q;

    if ($keyword) {
        $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')
            ->get();
    } else {
        $produk = Produk::all();
    }
    return view('index', compact('produk'));
}


    public function indexsudahlog(Request $request){
    $keyword = $request->q;

    if ($keyword) {
        $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')
            ->get();
    } else {
        $produk = Produk::all();
    }
    return view('indexsudahlog', compact('produk'));
}

}
