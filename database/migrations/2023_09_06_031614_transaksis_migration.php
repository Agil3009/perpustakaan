<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->integer('buku_id');
            $table->string('nama');
            $table->string('status');
            $table->date('tgl_pinjam');
            $table->date('batas_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->string('alasan')->nullable();
            $table->timestamps();
            $table->string('created_user')->nullable();
            $table->string('updated_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
