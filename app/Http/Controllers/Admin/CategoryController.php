<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori, dipakai di halaman index kategori (list data)
     */
    public function index()
    {
        // Mengambil semua data kategori dari tabel kategori
        $categories = Kategori::all();

        // Mengirim data kategori ke view admin.category.index
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan kategori baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        // Field 'nama' wajib diisi, harus berupa string, dan maksimal 255 karakter
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Pengecekan tambahan jika 'nama' tidak ada di payload
        if (!isset($payload['nama'])) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Nama kategori wajib diisi.');
        }

        // Menyimpan data kategori baru ke database
        Kategori::create([
            'nama' => $payload['nama'],
        ]);

        // Redirect kembali ke halaman index kategori dengan pesan sukses
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu kategori.
     */
    public function show(string $id)
    {
        // Digunakan untuk menampilkan detail kategori
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(string $id)
    {
        // Mengambil data berdasarkan ID lalu kirim ke view edit
    }

    /**
     * Memperbarui data kategori yang sudah ada
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form edit
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Pengecekan tambahan jika 'nama' tidak ada di payload
        if (!isset($payload['nama'])) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Nama kategori wajib diisi.');
        }

        // Mencari kategori berdasarkan ID
        // Jika tidak ditemukan, akan otomatis error 404
        $category = Kategori::findOrFail($id);

        // Mengubah nama kategori
        $category->nama = $payload['nama'];
 
        // Menyimpan perubahan ke database
        $category->save();

        // Redirect kembali ke halaman index kategori dengan pesan sukses
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori berdasarkan ID.
     */
    public function destroy(string $id)
    {
        // Menghapus data kategori langsung berdasarkan ID 
        Kategori::destroy($id);

        // Redirect kembali ke halaman index kategori dengan pesan sukses
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
