<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga_per_kg',
        'estimasi_hari',
        'aktif',
    ];

    protected $casts = [
        'harga_per_kg' => 'decimal:2',
        'aktif' => 'boolean',
    ];

    public function order()
    {
        return $this->hasMany(Pesanan::class, 'layanan_id');
    }
}