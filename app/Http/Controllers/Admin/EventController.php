<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Kategori;


class EventController extends Controller
{
    /**
     * Menampilkan daftar semua event.
     */
    public function index()
    {
        // Mengambil semua data event dari tabel events
	    $events = Event::all();

        // Mengirim data event ke view admin.event.index
	    return view(
            'admin.event.index', 
            compact('events'));
    }

    /**
     * Menampilkan form untuk menambahkan event baru.
     */
    public function create()
    {
        // Mengambil semua kategori untuk dropdown pilihan kategori
        $categories = Kategori::all();

        // Mengirim data kategori ke view admin.event.create
        return view(
            'admin.event.create', 
            compact('categories'));
    }

    /**
     * Menyimpan data event baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika user mengunggah file gambar, simpan ke folder public/images/events
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/events'), $imageName);

            // Simpan nama file gambar ke dalam data yang akan disimpan
            $validatedData['gambar'] = $imageName;
        }

        // Menyimpan ID user yang membuat event (jika login)
        $validatedData['user_id'] = auth()->user()->id ?? null;

        // Menyimpan data event baru ke database
        Event::create($validatedData);

        // Redirect kembali ke halaman list event dengan pesan sukses
        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail event
     */
    public function show(string $id)
    {
        // Mengambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        // Mengambil semua kategori untuk ditampilkan di detail event
        $categories = Kategori::all();

        // Mengambil tiket terkait dengan event
        $tickets = $event->tikets;

        // Mengirim data ke halaman detail event
        return view(
            'admin.event.show', 
            compact('event', 'categories', 'tickets'));
    }

    /**
     * Menampilkan form edit event
     */
    public function edit(string $id)
    {
        // Mengambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        // Mengambil semua kategori untuk dropdown
        $categories = Kategori::all();

        // // Menampilkan halaman edit event
        return view(
            'admin.event.edit', 
            compact('event', 'categories'));
    }

    /**
     * Memperbarui data event
     */
    public function update(Request $request, string $id)
    {
        try {
            // Mengambil event berdasarkan ID
            $event = Event::findOrFail($id);

            // Validasi data input
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal_waktu' => 'required|date',
                'lokasi' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategoris,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Jika admin mengunggah file gambar baru
            if ($request->hasFile('gambar')) {
                $imageName = time().'.'.$request->gambar->extension();
                $request->gambar->move(public_path('images/events'), $imageName);

                // Update nama file gambar di database
                $validatedData['gambar'] = $imageName;
            }

            // Update data event
            $event->update($validatedData);

            // Redirect ke halaman list event dengan pesan sukses
            return redirect()
                ->route('admin.events.index')
                ->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
             // Jika terjadi error, kembali ke halaman sebelumnya
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Terjadi kesalahan saat memperbarui event: ' . $e->getMessage()
                ]);
        }
    }

    /**
     * Menghapus event
     */
    public function destroy(string $id)
    {
        // Mengambil event berdasarkan ID
        $event = Event::findOrFail($id);

        // Menghapus data event
        $event->delete();

        // Redirect ke halaman list event dengan pesan sukses
        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
