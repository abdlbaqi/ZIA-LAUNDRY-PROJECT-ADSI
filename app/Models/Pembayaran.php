<?php

// app/Models/Pembayaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['user_id', 'pesanan_id', 'total_harga','metode', 'bukti', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

   
}
