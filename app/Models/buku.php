<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    public $table = "bukus";
    protected $fillable = [
        "judul",
        "kategori_id",
        "penulis",
        "deskripsi",
        "foto",
        "created_user",
        "updated_user"
    ];
    public function data_katagori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }
}
