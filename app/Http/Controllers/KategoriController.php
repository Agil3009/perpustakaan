<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function list()
    {
        $data = Kategori::get();
        return view('content.list-kategori', compact('data'));
    }

    public function tambahKategori()
    {
        $nama = Kategori::where('nama', request('nama'))->exists();
        if ($nama) {
            return redirect()->back()->with([
                'error' => true,
                'massage' => 'nama ' . request('nama') . ' Sudah Terdaftar'
            ]);
        }

        $ins = Kategori::create([
            'nama' => request('nama'),
            'created_user' => auth()->user()->nama
        ]);

        if ($ins) {
            return redirect()->back()->with([
                'error' => false,
                'massage' => 'Tambah Pengguna Berhasil'
            ]);
        }

        return redirect()->back()->with([
            'error' => true,
            'massage' => 'Tambah Pengguna Gagal'
        ]);
    }

    public function detailKategori($id)
    {
        $data = Kategori::find($id);
        if ($data == null) {
            return redirect()->route('kategori.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return view('content.detail-kategori', compact('data'));
    }

    public function updateKategori($id)
    {
        $validate = request()->validate([
            'nama' => ['required']
        ]);

        $nama = Kategori::where('nama', request('nama'))->exists();
        if ($nama) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Nama katagori ' . request('nama') . ' sudah terdaftar'
            ]);
        }

        $data = Kategori::find($id);
        if ($data == null) {
            return redirect()->route('kategori.index')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $upd = $data->update([
            'nama' => request('nama'),
            'updated_user' => auth()->user()->nama
        ]);

        if ($upd) {
            return redirect()->route('kategori.list')->with([
                'error' => false,
                'message' => 'Ubah Katagori Berhasil'
            ]);
        }
        return redirect()->back()->with([
            'error' => true,
            'message' => 'Ubah Katagori Gagal'
        ]);
    }

    public function editKategori($id)
    {
        $data = Kategori::find($id);
        if ($data == null) {
            return redirect()->route('kategori.index')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return view('content.edit-kategori', compact('data'));
    }

    public function hapusKategori($id)
    {
        $data = Kategori::find($id);
        if ($data == null) {
            return redirect()->route('kategori.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $del = $data->delete();
        if ($del) {
            return redirect()->route('kategori.list')->with([
                'error' => false,
                'message' => 'Hapus Kategori Berhasil'
            ]);
        }

        return redirect()->route('kategori.list')->with([
            'error' => true,
            'message' => 'Hapus Kategori Gagal'
        ]);
    }
}
