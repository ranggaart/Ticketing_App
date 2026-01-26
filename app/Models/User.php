<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Field yang boleh diisi secara mass assignment
     * 
     * Digunakan saat:
     * - Registrasi user
     * - Update data user
     * Contoh: User::create([...])
     */
    protected $fillable = [
        'name', // Nama lengkap user
        'email', // Alamat email user
        'password', // Password user 
        'no_hp', // Nomor handphone user
        'role', // Role user (contoh: admin, user)
    ];

    /**
     * Field yang disembunyikan saat data user ditampilkan
     * 
     * Berguna untuk keamanan agar data sensitif
     * tidak ikut terkirim ke frontend atau API
     */
    protected $hidden = [
        'password', // Password disembunyikan
        'remember_token', // Token untuk "ingat saya" disembunyikan
    ];

     /**
     * Casting tipe data otomatis
     * 
     * Fungsi casts:
     * - Mengubah format data dari database ke PHP
     * - Mengamankan password dengan hashing otomatis
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // email_verified_at sebagai DateTime
            'password' => 'hashed', // Password otomatis di-hash saat disimpan
        ];
    }
}