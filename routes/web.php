<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PinjamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengguna', [PenggunaController::class, 'list'])->name('pengguna.list');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'tambahPengguna'])->name('pengguna.tambah');
    Route::get('/pengguna/detail/{id}', [PenggunaController::class, 'detailPengguna'])->name('pengguna.detail');
    Route::put('/pengguna/update/{id}', [PenggunaController::class, 'updatePengguna'])->name('pengguna.update');
    Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'editPengguna'])->name('pengguna.edit');
    Route::get('/pengguna/hapus/{id}', [PenggunaController::class, 'hapusPengguna'])->name('pengguna.hapus');

    Route::get('/buku', [BukuController::class, 'list'])->name('buku.list');
    Route::post('/buku/tambah', [BukuController::class, 'tambahBuku'])->name('buku.tambah');
    Route::get('/buku/detail/{id}', [BukuController::class, 'detailBuku'])->name('buku.detail');
    Route::get('/buku/edit/{id}', [BukuController::class, 'editBuku'])->name('buku.edit');
    Route::put('/buku/update/{id}', [BukuController::class, 'updateBuku'])->name('buku.update');
    Route::get('/buku/hapus/{id}', [BukuController::class, 'hapusBuku'])->name('buku.hapus');

    Route::get('/kategori', [KategoriController::class, 'list'])->name('kategori.list');
    Route::post('/kategori/tambah', [KategoriController::class, 'tambahKategori'])->name('kategori.tambah');
    Route::get('/kategori/detail/{id}', [KategoriController::class, 'detailKategori'])->name('kategori.detail');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'updateKategori'])->name('kategori.update');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'editKategori'])->name('kategori.edit');
    Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapusKategori'])->name('kategori.hapus');


    Route::get('/pinjam', [PinjamController::class, 'list'])->name('pinjam.list');
    Route::post('/pinjam', [PinjamController::class, 'simpanPinjam'])->name('pinjam.simpan');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'proclogin'])->name('proc.login');
