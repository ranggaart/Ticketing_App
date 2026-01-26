<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan detail satu event ke halaman user
     */
    public function show(Event $event)
    {
        // Memuat relasi yang dibutuhkan: tikets, kategori, user
        $event->load(['tikets', 'kategori', 'user']);

        // Mengirim data event ke view events.show
        return view('events.show', compact('event'));
    }
}
