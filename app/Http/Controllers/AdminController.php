<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Middleware cek admin - taruh di constructor
    public function __construct()
    {
        // Uncomment ini kalau sudah ada sistem role
        // $this->middleware('admin');
    }

    // ── DASHBOARD ──────────────────────────────
    public function index()
    {
    if (!session('is_admin')) {
        return redirect()->route('admin.login');
    }

        $produk  = Produk::orderBy('id_produk', 'desc')->get();
        $pesanan = Pesanan::with(['user', 'produk', 'detailPesanan'])
                         ->orderBy('tanggal', 'desc')
                         ->get();

        return view('admin', compact('produk', 'pesanan'));
    }

    // ── PRODUK: TAMBAH ──────────────────────────
    public function tambahProduk(Request $request)
    {
        $request->validate([
            'nama_produk'   => 'required|string|max:255',
            'harga_produk'  => 'required|numeric|min:0',
            'stok_produk'   => 'required|integer|min:0',
            'gambar_produk' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Simpan gambar ke folder public/images
        $file = $request->file('gambar_produk');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $namaFile);

        Produk::create([
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk'     => $request->harga_produk,
            'stok_produk'      => $request->stok_produk,
            'kategori'         => $request->kategori,
            'gambar_produk'    => $namaFile,
        ]);

        return redirect()->route('admin')->with('success', 'Produk berhasil ditambahkan!');
    }

    // ── PRODUK: EDIT ────────────────────────────
    public function editProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk'  => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk'  => 'required|integer|min:0',
            'gambar_produk'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $namaFile = $produk->gambar_produk;

        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama
            $pathLama = public_path('images/' . $produk->gambar_produk);
            if (file_exists($pathLama)) unlink($pathLama);

            // Simpan gambar baru
            $file = $request->file('gambar_produk');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $namaFile);
        }

        $produk->update([
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk'     => $request->harga_produk,
            'stok_produk'      => $request->stok_produk,
            'kategori'         => $request->kategori,
            'gambar_produk'    => $namaFile,
        ]);

        return redirect()->route('admin')->with('success', 'Produk berhasil diupdate!');
    }

    // ── PRODUK: HAPUS ───────────────────────────
    public function hapusProduk($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar dari folder
        $pathGambar = public_path('images/' . $produk->gambar_produk);
        if (file_exists($pathGambar)) unlink($pathGambar);

        $produk->delete();

        return response()->json(['success' => true]);
    }

    // ── PESANAN: UPDATE STATUS ───────────────────
    public function updateStatusPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = $request->status;
        $pesanan->save();

        return response()->json(['success' => true]);
    }

    // Tampilkan halaman login admin
public function loginForm()
{
    if (session('is_admin')) {
        return redirect()->route('admin');
    }
    return view('admin_login');
}

// Proses login admin
public function loginPost(Request $request)
{
    $passwordAdmin = env('ADMIN_PASSWORD', 'admin123'); // ambil dari .env

    if ($request->password === $passwordAdmin) {
        session(['is_admin' => true]);
        return redirect()->route('admin');
    }

    return redirect()->route('admin.login')
                     ->with('error', 'Password salah!');
}

// Logout admin
public function logout()
{
    session()->forget('is_admin');
    return redirect()->route('admin.login');
}
}
