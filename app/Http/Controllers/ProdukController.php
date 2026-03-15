<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
    $produk = Produk::all(); // mengambil semua produk dari database
    return view('produk.index', compact('produk'));
    }
}
