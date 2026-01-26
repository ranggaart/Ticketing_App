<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Models\Kategori;
use App\Models\Event;

/**
 * Halaman utama (homepage)
 * Diakses oleh semua user (tanpa login)
 * Controller: HomeController@index
 */
Route::get('/', action: [HomeController::class, 'index'])->name('home');

/**
 * Halaman detail event untuk user
 * {event} akan otomatis di-bind ke model Event (Route Model Binding)
 * Controller: User\EventController@show
 */
Route::get('/events/{event}', [UserEventController::class, 'show'])->name('events.show');

/**
 * Menampilkan daftar order milik user
 */
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

/**
 * Menampilkan detail order berdasarkan ID
 */
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

/**
 * Menyimpan order baru (checkout)
 */
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::middleware('auth')->group(function () {
    
    // Halaman edit profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Update data profile user
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Hapus akun user
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Category Management
        Route::resource('categories', CategoryController::class);

        // Event Management
        Route::resource('events', AdminEventController::class);

        // Tiket Management 
        Route::resource('tickets', TiketController::class);
        
        // Ticket Type
        Route::resource('ticket-types', TicketTypeController::class);

        // Histories
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });
});

require __DIR__ . '/auth.php';
