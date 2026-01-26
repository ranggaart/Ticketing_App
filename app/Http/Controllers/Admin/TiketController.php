<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketController extends Controller
{
    /**
     * Menampilkan daftar tiket
     */
    public function index()
    {
        //
    }

    /**
     * Menampilkan form untuk menambah tiket baru
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan data tiket baru ke database
     */
    public function store(Request $request)
    {
         // Validasi data yang dikirim dari form
        $validatedData = request()->validate([
            'event_id' => 'required|exists:events,id', // event_id wajib diisi dan harus ada di tabel events
            'tipe' => 'required|string|max:255', // tipe tiket berupa teks dan maksimal 255 karakter
            'harga' => 'required|numeric|min:0', // harga harus berupa angka dan minimal 0
            'stok' => 'required|integer|min:0', // stok harus berupa angka bulat dan minimal 0
        ]);

        // Menyimpan data tiket ke database
        Tiket::create($validatedData);

        // Redirect kembali ke halaman detail event, sekaligus menampilkan pesan sukses
        return redirect()
            ->route('admin.events.show', $validatedData['event_id'])
            ->with('success', 'Ticket berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail tiket 
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form edit tiket
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Memperbarui data tiket yang sudah ada
     */
    public function update(Request $request, string $id)
    {
        // Mengambil data tiket berdasarkan ID
        // Jika tidak ditemukan, akan otomatis error 404
        $ticket = Tiket::findOrFail($id);

        // Validasi data input dari form edit
        $validatedData = $request->validate([
            'tipe' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Mengupdate data tiket di database
        $ticket->update($validatedData);

        // Redirect kembali ke halaman detail event dengan pesan sukses
        return redirect()
            ->route('admin.events.show', $ticket->event_id)
            ->with('success', 'Ticket berhasil diperbarui.');
    }

    /**
     * Menghapus data tiket
     */
    public function destroy(string $id)
    {
        // Mengambil data tiket berdasarkan ID
        $ticket = Tiket::findOrFail($id);

        // Menyimpan event_id sebelum tiket dihapus
        $eventId = $ticket->event_id;

        // Menghapus tiket dari database
        $ticket->delete();

        // Redirect kembali ke halaman detail event dengan pesan sukses
        return redirect()
            ->route('admin.events.show', $eventId)
            ->with('success', 'Ticket berhasil dihapus.');
    }
}
