<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    /**
     * $fillable digunakan untuk menentukan
     * field apa saja yang boleh diisi secara massal
     * (misalnya saat create atau update).
     */
    protected $fillable = [
        'event_id', // ID event yang memiliki tipe tiket ini
        'name', // Nama tipe tiket (contoh: VIP, Reguler)
        'price', // Harga untuk tipe tiket ini
        'quota', // Kuota atau jumlah tiket yang tersedia untuk tipe ini
    ];

    /**
     * Relasi: TicketType -> Event (Many to One)
     *
     * Artinya:
     * - Satu TicketType hanya dimiliki oleh satu Event
     * - Satu Event bisa memiliki banyak TicketType
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
