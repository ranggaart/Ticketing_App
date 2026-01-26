<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', // Nama kategori event (contoh: Seminar, Konser, Workshop)
    ];

    /**
     * Relasi ke model Event
     * 
     * Satu kategori bisa memiliki banyak event
     * Contoh: kategori "Seminar" berisi banyak event seminar
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}