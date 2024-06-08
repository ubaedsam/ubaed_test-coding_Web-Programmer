<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    use HasFactory;

    protected $table = "pemesanan_produk"; // menghubungkan ke dalam tabel pemesanan_produk
    protected $guarded = [];

    public $primaryKey = 'id_pemesanan_produk';
    public $keyType = 'string';
    public $autoIncrement = 'false';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
