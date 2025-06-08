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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanan')->onDelete('cascade');
            $table->decimal('berat_kg', 8, 2);
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['menunggu', 'diproses', 'dicuci', 'dikeringkan', 'disetrika', 'siap', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->date('tanggal_ambil');
            $table->date('tanggal_selesai');
            $table->text('catatan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
