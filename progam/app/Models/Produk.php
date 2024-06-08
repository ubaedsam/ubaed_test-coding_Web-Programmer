<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = "produk"; // menghubungkan ke dalam tabel produk

    protected $guarded = [];

    public $primaryKey = 'id_produk';
    public $keyType = 'string';
    public $autoIncrement = 'false';
}
