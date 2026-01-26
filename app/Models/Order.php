<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'total_harga' => 'decimal:2', // total_harga diperlakukan sebagai decimal dengan 2 angka di belakang koma
        'order_date' => 'datetime', // order_date diperlakukan sebagai object DateTime
    ];

    /**
     * Field yang boleh diisi secara mass assignment
     * Digunakan saat Order::create()
     */
    protected $fillable = [
        'user_id', // ID user yang melakukan pemesanan
        'event_id', // ID event yang dipesan
        'order_date', // Tanggal dan waktu pemesanan
        'total_harga', // Total harga dari seluruh pesanan
    ];

     /**
     * Relasi ke User
     * 
     * Satu order dimiliki oleh satu user
     * Contoh: untuk mengetahui siapa yang memesan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Many-to-Many ke Tiket
     * 
     * - Order bisa memiliki banyak tiket
     * - Tiket bisa ada di banyak order
     * - Menggunakan tabel pivot: detail_orders
     * - withPivot digunakan untuk mengambil data tambahan
     *   seperti jumlah tiket dan subtotal harga
     */
    public function tikets()
    {
        return $this->belongsToMany(Tiket::class, 'detail_orders')
            ->withPivot('jumlah', 'subtotal_harga');
    }

    /**
     * Relasi ke Event
     * 
     * Satu order hanya untuk satu event
     * Contoh: order ini dibuat untuk event apa
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Relasi ke DetailOrder
     * 
     * Satu order memiliki banyak detail order
     * Biasanya digunakan untuk melihat rincian tiket per order
     */
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}