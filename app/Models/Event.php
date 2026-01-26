<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ID user (admin/penyelenggara) yang membuat event
        'judul', // Judul atau nama event
        'deskripsi', // Deskripsi lengkap event
        'tanggal_waktu', // Tanggal dan waktu pelaksanaan event
        'lokasi', // Lokasi event
        'kategori_id', // ID kategori event
        'gambar', // Nama file gambar event
    ];

    /**
     * Casting atribut
     * 
     * tanggal_waktu otomatis diperlakukan sebagai object DateTime
     */
    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    /**
     * Relasi ke model Tiket
     * 
     * Satu event bisa memiliki banyak tiket
     * Contoh: VIP, Reguler, Gratis
     */
    public function tikets()
    {
        return $this->hasMany(Tiket::class);
    }

    /**
     * Relasi ke model TicketType
     * 
     * Alternatif tipe tiket (jika menggunakan tabel ticket_types)
     */
    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    /**
     * Relasi ke model Kategori
     * 
     * Setiap event hanya memiliki satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke model User
     * 
     * Menunjukkan siapa pembuat / penyelenggara event
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
