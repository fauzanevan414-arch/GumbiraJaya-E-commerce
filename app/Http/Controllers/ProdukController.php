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
        // 🔥 CEK LOGIN
        if (!session('user_id')) {
            return response()->json(['error' => 'Harus login dulu']);
        }

        $user_id = session('user_id');

        $item = Keranjang::where('user_id', $user_id)
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($item) {
            $item->qty += $request->qty;
            $item->save();
        } else {
            Keranjang::create([
                'user_id' => $user_id,
                'produk_id' => $request->produk_id,
                'qty' => $request->qty
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function tambahPesanan(Request $request)
    {
        // 🔥 CEK LOGIN
        if (!session('user_id')) {
            return response()->json(['error' => 'Harus login dulu']);
        }

        Pesanan::create([
            'user_id' => session('user_id'),
            'produk_id' => $request->produk_id,
            'qty' => $request->qty
        ]);

        return response()->json(['success' => true]);
    }

    public function keranjang()
    {
        // 🔥 CEK LOGIN
        if (!session('user_id')) {
            return redirect('/login');
        }

        $keranjang = Keranjang::where('user_id', session('user_id'))
            ->with('produk')
            ->get();

        return view('keranjang', compact('keranjang'));
    }
}