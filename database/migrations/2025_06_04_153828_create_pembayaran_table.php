<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // foreign key ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // foreign key ke pesanan
            $table->foreignId('pesanan_id')
                  ->constrained('pesanan')
                  ->cascadeOnDelete();

            // total harga yang dibayar (diambil dari pesanan.total_harga)
            $table->integer('total_harga');

            // metode pembayaran: Transfer Bank, COD, dll.
            $table->string('metode');

            // path file bukti transfer (jika ada)
            $table->string('bukti')->nullable();

            // status: pending, terverifikasi, atau gagal
            $table->enum('status', ['pending', 'terverifikasi', 'gagal'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
