<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi secara mass assignment
     * Contoh penggunaan: Tiket::create([...])
     */
    protected $fillable = [
        'event_id', // ID event yang terkait
        'tipe', // Tipe tiket (contoh: VIP, Reguler)
        'harga', // Harga tiket
        'stok', // Stok atau jumlah tiket yang tersedia
    ];

    /**
     * Relasi: Tiket -> Event
     * 
     * Jenis relasi: Many to One
     * Artinya:
     * - Satu tiket hanya dimiliki oleh satu event
     * - Satu event bisa memiliki banyak tiket
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relasi: Tiket -> DetailOrder
     * 
     * Jenis relasi: One to Many
     * Artinya:
     * - Satu tiket bisa muncul di banyak detail order
     * - Biasanya terjadi saat tiket dibeli berkali-kali
     * 
     * Digunakan untuk melihat detail transaksi tiket
     */
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }

    /**
     * Relasi: Tiket -> Order
     * 
     * Jenis relasi: Many to Many
     * Artinya:
     * - Satu tiket bisa dibeli di banyak order
     * - Satu order bisa memiliki banyak tiket
     * 
     * Menggunakan tabel perantara (pivot) bernama `detail_orders`
     * 
     * withPivot():
     * - Digunakan untuk mengambil data tambahan
     *   seperti jumlah tiket dan subtotal harga
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'detail_orders')
            ->withPivot('jumlah', 'subtotal_harga');
    }
}