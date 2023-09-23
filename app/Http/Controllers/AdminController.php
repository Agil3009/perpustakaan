<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\buku;

class AdminController extends Controller
{
    public function dashboard()
    {
        // dd($this->bukuPinjam());
        $bukuPinjam = Transaksi::where(['status' => 'pinjam'])->get();
        $bukuKembali = Transaksi::where(['status' => 'kembali'])->get();
        $bukuKembaliTelat = Transaksi::where(['status' => 'kembali', 'st_kembali' => 'telat'])->get();
        return view('content.dashboard', compact('bukuPinjam', 'bukuKembali', 'bukuKembaliTelat'));
    }

    // public function bukuPinjam()
    // {
    //     $data = 

    //     return $data;
    // }
    // public function bukuKembali()
    // {
    //     $data = 

    //     return $data;
    // }

    // public function bukuKembaliTelat()
    // {
    //     $data = Transaksi::where(['status' => 'kembali', 'st_kembali' => 'telat'])->first();

    //     return $data;
    // }
}
