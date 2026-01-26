<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', // ID dari tabel orders (relasi ke order utama)
        'tiket_id', // ID tiket yang dipesan
        'jumlah', // Jumlah tiket yang dibeli
        'subtotal_harga', // Total harga untuk tiket ini (harga x jumlah)
    ];

     /**
     * Relasi ke model Order
     * 
     * Setiap detail order hanya dimiliki oleh satu order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke model Tiket
     * 
     * Setiap detail order mengacu ke satu tiket tertentu
     */
    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}