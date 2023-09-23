<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Carbon;

class PinjamController extends Controller
{
    public function list()
    {
        $data = Transaksi::all();
        return view('content.list-pinjam', compact('data'));
    }

    public function simpanPinjam()
    {
        $validate = request()->validate([
            'nama' => ['required'],
            'alamat' => ['required'],
            'buku_id' => ['required', 'numeric'],
            'status' => ['required'],
            "tanggal" => ["required", "date"],
        ]);

        if ($this->cekBukuPinjam(request('nama'), request('buku_id'), request('status'))) {
            return redirect()->back()->with([
                'error' => true,
                'massage' => 'Peminjaman atau Pengembalian Barang Gagal, Buku Kosong atau pengembalian buku berbeda'
            ]);
        }
        // dd(request('status') == 'pinjam');
        if (request('status') == 'pinjam') {
            $ins = Transaksi::create([
                'nama' => request('nama'),
                'alamat' => request('alamat'),
                'buku_id' => request('buku_id'),
                'status' => request('status'),
                'tanggal' => request('tanggal'),
                'st_kembali' => '',
                'created_user' => auth()->user()->nama
            ]);
        } else {
            if ($this->cekTanggal(request('nama'), request('buku_id'), request('status'), request('tanggal'))) {
                $ins = Transaksi::create([
                    'nama' => request('nama'),
                    'alamat' => request('alamat'),
                    'buku_id' => request('buku_id'),
                    'status' => request('status'),
                    'tanggal' => request('tanggal'),
                    'st_kembali' => 'telat',
                    'created_user' => auth()->user()->nama
                ]);
            } else {
                $ins = Transaksi::create([
                    'nama' => request('nama'),
                    'alamat' => request('alamat'),
                    'buku_id' => request('buku_id'),
                    'status' => request('status'),
                    'tanggal' => request('tanggal'),
                    'st_kembali' => 'tepat',
                    'created_user' => auth()->user()->nama
                ]);
            }
        }

        if ($ins) {
            if ($this->cekTanggal(request('nama'), request('buku_id'), request('status'), request('tanggal'))) {
                return redirect()->back()->with([
                    'error' => true,
                    'massage' => 'tanggal lebih dari 30 hari'
                ]);
            }

            return redirect()->back()->with([
                'error' => false,
                'massage' => 'Peminjam Atau Pengembalian Buku Berhasil'
            ]);
        }

        return redirect()->back()->with([
            'error' => true,
            'massage' => 'Peminjam Atau Pengembalian Buku Berhasil'
        ]);
    }

    public function cekBukuPinjam($nama, $idbuku, $status)
    {
        $buku = buku::find($idbuku);

        $namatrasansiPinjam = Transaksi::where(['nama' => $nama, 'status' => 'pinjam', "buku_id" => $idbuku])->count('buku_id');
        $namatrasansikembali = Transaksi::where(['nama' => $nama, 'status' => 'kembali', "buku_id" => $idbuku])->count('buku_id');
        $trasansiPinjam = Transaksi::where(['status' => 'pinjam', "buku_id" => $idbuku])->count('buku_id');
        $trasansikembali = Transaksi::where(['status' => 'kembali', "buku_id" => $idbuku])->count('buku_id');

        if (($status == 'kembali' && $namatrasansiPinjam != 1) || ($status == 'pinjam' && ($trasansiPinjam != $trasansikembali))) {

            return true;
        }

        return false;
    }

    public function cekTanggal($nama, $idbuku, $status, $tanggal)
    {
        $tglpinjam = Transaksi::where(['nama' => $nama, 'status' => 'pinjam', "buku_id" => $idbuku])->first();
        $tglkembali = Transaksi::where(['nama' => $nama, 'status' => 'kembali', "buku_id" => $idbuku])->first();
        // dd($tglpinjam);

        if ($tglpinjam == null) {
            $pinjam = date_create($tanggal);
        } else {
            $pinjam = date_create($tglpinjam->tanggal);
        }
        $kembali = date_create($tanggal);

        $diff = date_diff($pinjam, $kembali);
        // dd($diff->days);
        // dd(($status == 'kembali' || $status == 'pinjam'), $diff->days <= 30);
        if (($status == 'kembali' || $status == 'pinjam') && $diff->days <= 30) {
            return false;
        }
        return true;
    }
}
