<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; // nama tabel di database

    protected $primaryKey = 'id_kategori'; // karena kamu pakai id_kategori

    protected $fillable = [
        'nama',
        'gambar'
    ];
}
