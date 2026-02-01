<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nis',
        'no_telp',
        'alamat',
        'tanggal_daftar',
        'status_anggota'
    ];


public function user()
{
    return $this->belongsTo(User::class);
}

}
