<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function list()
    {
        $data = User::get();
        return view('content.list-pengguna', compact('data'));
    }

    public function tambahpengguna()
    {
        $validate = request()->validate([
            'nama' => ['required'],
            'nip' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password' => ['required'],
            'retype_password' => ['required']
        ]);

        $exists = User::where('email', request('email'))->exists();
        if ($exists) {
            return redirect()->back()->with([
                'error' => true,
                'massage' => 'email ' . request('email') . ' Sudah Terdaftar'
            ]);
        }

        $nip = User::where('nip', request('nip'))->exists();
        if ($nip) {
            return redirect()->back()->with([
                'error' => true,
                'massage' => 'nip ' . request('nip') . ' Sudah Terdaftar'
            ]);
        }

        $ins = User::create([
            'nama' => request('nama'),
            'nip' => request('nip'),
            'email' => request('email'),
            'role' => request('role'),
            'password' => bcrypt(request('password'))
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

    public function detailPengguna($id)
    {
        $data = User::find($id);
        if ($data == null) {
            return redirect()->route('pengguna.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan',
            ]);
        }
        return view('content.detail-pengguna', compact('data'));
    }

    public function updatePengguna($id)
    {
        $validate = request()->validate([
            'nama' => ['required'],
            'nip' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password' => ['nullable'],
            'retype_password' => ['nullable', 'same:password']
        ]);

        $pengguna = User::where('email', request('email'));
        $oldEmail = $pengguna->first()->email;
        if ($oldEmail != request("email")) {
            if ($pengguna->exist()) {
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'email ' . request('email') . ' sudah terdaftar'
                ]);
            }
        }

        $data = User::find($id);
        if ($data == null) {
            return redirect()->route('pengguna.list')->with([
                'error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $updateData = [
            'nama' => request('nama'),
            'nip' => request('nip'),
            'email' => request('email'),
            'role' => request('role'),

        ];

        if (request()->has('password') && request('password') != null) {
            $updateData['password'] = bcrypt(request('password'));
        }

        $upd = $data->update($updateData);
        if ($upd) {
            return redirect()->route('pengguna.list')->with([
                'error' => false,
                'message' => 'Ubah User Berhasil'
            ]);
        }

        return redirect()->back()->with([
            'error' => true,
            'message' => 'Ubah User Gagal'
        ]);
    }

    public function editPengguna($id)
    {
        $data = User::find($id);
        if ($data == null) {
            return redirect()->route('pengguna.list')->with([
                'error' => true,
                'massage' => 'Data Tidak Ditemukan'
            ]);
        }
        return view('content.edit-pengguna', compact('data'));
    }

    public function hapusPengguna($id)
    {
        $data = User::find($id);
        if ($data == null) {
            return redirect()->route('pengguna.list')->with([
                'error' => false,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $del = $data->delete();
        if ($del) {
            return redirect()->route('pengguna.list')->with([
                'error' => false,
                'message' => 'Hapus Gudang Berhasil'
            ]);
        }

        return redirect()->route('pengguna.list')->with([
            'error' => True,
            'message' => 'Hapus Gudang Gagal'
        ]);
    }
}
