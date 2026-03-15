<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
    $produk = Produk::latest()->get();
    return view('user.index', compact('produk'));
    }
}
