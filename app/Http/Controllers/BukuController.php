<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function list()
    {
        $data = buku::with(['data_katagori'])->get();
        return view('content.list-buku', compact('data'));
    }

    public function tambahBuku()
    {
        $validate = request()->validate([
            "judul" => ["required"],
            "kategori_id" => ["required", "numeric"],
            "penulis" => ["required"],
            "deskripsi" => ["required"],
            "foto" => ["required", "mimes:jpeg,png,jpg"]
        ]);

        if (request()->has('foto')) {
            $filename = time() . '.' . request()->foto->extension();
            Storage::disk('public')->putFileAs('/images', request()->foto, $filename);
        }

        $ins = buku::create([
            "judul" => request("judul"),
            "kategori_id" => request("kategori_id"),
            "penulis" => request("penulis"),
            "deskripsi" => request("deskripsi"),
            "foto" => $filename,
            "created_user" => auth()->user()->nama
        ]);

        if ($ins) {
            return redirect()->back()->with([
                'error' => false,
                'massage' => 'Tambah Buku Berhasil'
            ]);
        }

        return redirect()->back()->with([
            'error' => true,
            'massage' => 'Tambah buku Gagal'
        ]);
    }

    public function detailBuku($id)
    {
        $data = buku::find($id);
        if ($data == null) {
            return redirect()->route('buku.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return view('content.detail-buku', compact('data'));
    }

    public function editBuku($id)
    {
        $data = buku::find($id);
        if ($data == null) {
            return redirect()->route('buku.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return view('content.edit-buku', compact('data'));
    }

    public function updateBuku($id)
    {
        $validate = request()->validate([
            "judul" => ["required"],
            "kategori_id" => ["required", "numeric"],
            "penulis" => ["required"],
            "deskripsi" => ["required"],
            "foto" => ["nullable", "mimes:jpeg,png,jpg"]
        ]);

        $data = buku::find($id);
        if ($data == null) {
            return redirect()->route('buku.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $updateData = [
            "judul" => request("judul"),
            "kategori_id" => request("kategori_id"),
            "penulis" => request("penulis"),
            "deskripsi" => request("deskripsi"),
        ];

        if (request()->has('foto') && request('foto') != null) {
            $filename = time() . '.' . request()->foto->extension();
            Storage::disk('public')->putFileAs('/images', request()->foto, $filename);
            $updateData['foto'] = $filename;
        }

        $upd = $data->update($updateData);
        if ($upd) {
            return redirect()->route('buku.list')->with([
                'error' => false,
                'message' => 'Ubah User Berhasil'
            ]);
        }

        return redirect()->back()->with([
            'error' => true,
            'message' => 'Ubah User Gagal'
        ]);
    }

    public function hapusBuku($id)
    {
        $data = buku::find($id);
        if ($data == null) {
            return redirect()->route('buku.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $del = $data->delete();
        if ($del) {
            return redirect()->route('buku.list')->with([
                'error' => false,
                'message' => 'Hapus Gudang Berhasil'
            ]);
        }

        return redirect()->route('buku.list')->with([
            'error' => True,
            'message' => 'Hapus Gudang Gagal'
        ]);
    }
}
