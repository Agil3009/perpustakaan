<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'buku_id',
        'status',
        'tanggal',
        'st_kembali',
        'created_user',
        'updated_user'
    ];

    public function data_buku()
    {
        return $this->hasOne(buku::class, 'id', 'buku_id');
    }
}
