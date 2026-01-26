<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoriesController extends Controller
{
    /**
     * Menampilkan halaman daftar riwayat pesanan (history).
    */        
    public function index()
    {
        // Mengambil semua data order, diurutkan dari yang paling baru
        $histories = Order::latest()->get();

        // Mengirim data $histories ke view admin.history.index
        return view(
            'admin.history.index', 
            compact('histories'));
    }

    /**
     * Menampilkan detail riwayat pesanan berdasarkan ID.
     */
    public function show(string $history)
    {
        // Mencari data order berdasarkan ID
        // Jika tidak ditemukan, otomatis menampilkan halaman 404
        $order = Order::findOrFail($history);

        // Mengirim data order ke view admin.history.show
        return view(
            'admin.history.show', 
            compact('order'));
    }
}
