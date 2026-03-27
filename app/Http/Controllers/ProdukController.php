<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;

        if ($keyword) {
            $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')->get();
        } else {
            $produk = Produk::all();
        }

        return view('index', compact('produk'));
    }

    public function indexsudahlog(Request $request)
    {
        $keyword = $request->q;

        if ($keyword) {
            $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')->get();
        } else {
            $produk = Produk::all();
        }

        return view('indexsudahlog', compact('produk'));
    }

    public function tambahKeranjang(Request $request)
    {
        // CEK LOGIN
        if (!session('id_user')) {
            return response()->json(['error' => 'Harus login dulu']);
        }

        $user_id = session('id_user');

        $item = Keranjang::where('id_user', $user_id)
            ->where('id_produk', $request->produk_id)
            ->first();

        if ($item) {
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            Keranjang::create([
                'id_user' => $user_id,
                'id_produk' => $request->produk_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function tambahPesanan(Request $request)
    {
        // CEK LOGIN
        if (!session('id_user')) {
            return response()->json(['error' => 'Harus login dulu']);
        }

        Pesanan::create([
            'id_user' => session('id_user'),
            'id_produk' => $request->produk_id,
            'jumlah' => $request->jumlah
        ]);

        return response()->json(['success' => true]);
    }

    public function keranjang()
    {
        // CEK LOGIN
        if (!session('id_user')) {
            return redirect('/login');
        }

        $keranjang = Keranjang::where('id_user', session('id_user'))
            ->with('produk')
            ->get();

        return view('keranjang', compact('keranjang'));
    }
}