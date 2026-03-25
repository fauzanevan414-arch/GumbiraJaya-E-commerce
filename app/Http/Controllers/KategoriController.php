<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
        public function category()
    {
        $kategori = Kategori::all();

        return view('kategoritoko', compact('kategori'));
    }

    public function show($id){
    $produk = Produk::where('id_kategori', $id)->get();
    return view('indexsudahlog', compact('produk'));
    }
    
}
