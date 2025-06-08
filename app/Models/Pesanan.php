<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'nomor_pesanan', 'user_id', 'layanan_id', 'berat_kg', 'total_harga',
        'tanggal_ambil', 'tanggal_selesai', 'catatan', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
    
    
    
    

}
