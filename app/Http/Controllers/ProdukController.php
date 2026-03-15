<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
    $produk = produk::latest()->get();
    return view('index', compact('produk'));
    }
}
