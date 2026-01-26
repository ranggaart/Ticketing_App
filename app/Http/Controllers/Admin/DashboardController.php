<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan statistik utama
     */
    public function index()
    {
        //  Menghitung total event yang ada di database
        $totalEvents = Event::count();

        // Menghitung total kategori yang ada di database
        $totalCategories = \App\Models\Kategori::count();

        // Menghitung total pesanan/order yang ada di database
        $totalOrders = Order::count();

        // Mengirim data statistik ke view admin.dashboard
        return view(
            'admin.dashboard', 
            compact('totalEvents', 'totalCategories', 'totalOrders')
            );
    }
}