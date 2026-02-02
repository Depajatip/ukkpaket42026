<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
        'gambar',
    ];
    
    public function transaksi()
{
    return $this->hasMany(Transaksi::class);
}
}

