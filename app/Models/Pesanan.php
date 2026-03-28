<?php

namespace App\Models;

use App\Models\DetailPesanan;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_produk',
        'tanggal',
        'total_harga',
        'status_pesanan',
        'metode_pesanan'
    ];


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function detail()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}
