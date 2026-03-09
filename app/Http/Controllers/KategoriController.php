<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
        public function index()
    {
        $kategori = [
            ['nama' => 'Perkakas', 'gambar' => 'perkakas.png'],
            ['nama' => 'Cover Knalpot', 'gambar' => 'knalpot.png'],
            ['nama' => 'Suku Cadang', 'gambar' => 'sukucadang.png'],
            ['nama' => 'Oli & Pelumas', 'gambar' => 'oli.png'],
            ['nama' => 'Filter Udara', 'gambar' => 'filterudara.png'],
            ['nama' => 'Kampas Rem', 'gambar' => 'kampasrem.png'],
        ];

        return view('kategoritoko', compact('kategori'));
    }
}
