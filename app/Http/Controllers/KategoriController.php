<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
        public function index()
    {
        $kategori = [
            ['nama' => 'Perkakas', 'gambar' => 'perkakas.png'],
            ['nama' => 'Oli', 'gambar' => 'oli.png'],
            ['nama' => 'Ban', 'gambar' => 'ban.png'],
            ['nama' => 'Aki', 'gambar' => 'aki.png']
        ];

        return view('kategoritoko', compact('kategori'));
    }
}
