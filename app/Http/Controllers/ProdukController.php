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
            $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $produk = Produk::all();
        }
        return view('index', compact('produk'));
    }


    public function indexsudahlog(Request $request)
    {
        $keyword = $request->q;

        if ($keyword) {
            $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $produk = Produk::all();
        }
        return view('indexsudahlog', compact('produk'));
    }

    public function tambahKeranjang(Request $request)
    {
        $user = auth()->user();

        $item = Keranjang::where('user_id', $user->id)
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($item) {
            $item->qty += $request->qty;
            $item->save();
        } else {
            Keranjang::create([
                'user_id' => $user->id,
                'produk_id' => $request->produk_id,
                'qty' => $request->qty
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function tambahPesanan(Request $request)
{
    Pesanan::create([
        'user_id' => auth()->id(),
        'produk_id' => $request->produk_id,
        'qty' => $request->qty
    ]);

    return response()->json(['success' => true]);
}
}
