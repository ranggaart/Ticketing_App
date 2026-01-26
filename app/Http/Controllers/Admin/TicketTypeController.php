<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Menampilkan daftar semua tipe tiket.
     */
    public function index()
    {
        // Mengambil semua data tipe tiket dari database
        $ticketTypes = TicketType::all();

        // Mengirim data ke view admin.ticket_type.index
        return view(
            'admin.ticket_type.index', 
            compact('ticketTypes'));
    }

    /**
     * Menampilkan form untuk menambahkan tipe tiket baru.
     */
    public function create()
    {
        // Mengambil semua event, diurutkan berdasarkan judul
        // Digunakan untuk pilihan event pada form
        $events = Event::orderBy('judul')->get();

        // Mengirim data event ke view form create
        return view(
            'admin.ticket_type.create', 
            compact('events'));
    }

    /**
     * Menyimpan data tipe tiket baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'event_id' => 'required|exists:events,id', // event harus ada di tabel events
            'name'     => 'required|string|max:100', // nama tipe tiket
            'price'    => 'required|numeric|min:0', // harga tiket
            'quota'    => 'required|integer|min:1', // kuota tiket
        ]);

        // Menyimpan data ke tabel ticket_types
        // Pastikan model TicketType sudah memiliki $fillable
        TicketType::create($request->all());

        // Redirect kembali ke halaman daftar tiket dengan pesan sukses
        return redirect()
            ->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil ditambahkan');
    }

    /**
     * Menampilkan detail tipe tiket
     */
    public function show(TicketType $ticketType)
    {
        // Mengirim data tiket ke halaman detail
        return view(
            'admin.ticket_type.show', 
            compact('ticketType')
        );
    }


    /**
     * Menampilkan form edit tipe tiket.
     */
    public function edit(TicketType $ticketType)
    {
        // Mengambil semua event untuk dropdown pilihan event
        $events = Event::orderBy('judul')->get();

        // Mengirim data tiket dan event ke view edit
        return view(
            'admin.ticket_type.edit', 
            compact('ticketType', 'events')
        );
    }

    /**
     * Memperbarui data tipe tiket di database.
     */
    public function update(Request $request, TicketType $ticketType)
    {
        // Validasi data input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name'     => 'required|string|max:255',
            'price'    => 'required|numeric|min:0',
            'quota'    => 'required|integer|min:1',
        ]);

        // Update data tipe tiket
        $ticketType->update([
            'event_id' => $request->event_id,
            'name'     => $request->name,
            'price'    => $request->price,
            'quota'    => $request->quota,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil diperbarui');
    }

    /**
     * Menghapus tipe tiket dari database.
     */
    public function destroy(TicketType $ticketType)
    {
        // Menghapus data tipe tiket
        $ticketType->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil dihapus');
    }
}
