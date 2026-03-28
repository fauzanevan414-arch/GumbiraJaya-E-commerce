<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
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
        if (!session('id_user')) {
            return response()->json(['success' => false, 'error' => 'Harus login dulu']);
        }

        try {
            $produk = Produk::find($request->produk_id);

            if (!$produk) {
                return response()->json(['success' => false, 'error' => 'Produk tidak ditemukan']);
            }

            // Cek apakah produk sudah ada di keranjang
            $keranjang = Keranjang::where('id_user', session('id_user'))
                ->where('id_produk', $request->produk_id)
                ->first();

            if ($keranjang) {
                // Kalau sudah ada, tambah jumlahnya
                $keranjang->jumlah += $request->jumlah;
                $keranjang->save();
            } else {
                // Kalau belum ada, buat baru
                Keranjang::create([
                    'id_user'   => session('id_user'),
                    'id_produk' => $request->produk_id,
                    'jumlah'    => $request->jumlah,
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
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


    public function tambahPesanan(Request $request)
    {
        if (!session('id_user')) {
            return response()->json(['error' => 'Harus login dulu']);
        }

        try {
            // 🔥 ambil produk
            $produk = Produk::find($request->produk_id);

            if (!$produk) {
                return response()->json(['error' => 'Produk tidak ditemukan']);
            }

            $pesanan = Pesanan::create([
                'id_user' => session('id_user'),
                'id_produk' => $request->produk_id,
                'tanggal' => now(),
                'total_harga' => $produk->harga_produk * $request->jumlah,
                'status_pesanan' => 'pending',
                'metode_pesanan' => 'whatsapp'
            ]);

            // 🔥 2. simpan ke detail_pesanan
            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga_produk
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function halamanPesanan()
    {
        if (!session('id_user')) {
            return redirect('/login');
        }

        $pesanan = Pesanan::where('id_user', session('id_user'))
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pesanan', compact('pesanan'));
    }
}
