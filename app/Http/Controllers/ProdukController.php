<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
    $produk = Produk::all(); // mengambil semua produk dari database
    return view('index', compact('produk'));
    }

    public function indexsudahlog(){
    $produk = Produk::all(); // mengambil semua produk dari database
    return view('indexsudahlog', compact('produk'));
    }
}
