<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GuideController;
use Illuminate\Support\Facades\Auth;

// Route root mengarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/ulasan', function () {
    return view('ulasan');
})->name('ulasan');

Route::get('/detail_status', function () {
    return view('detail_status');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/form', function () {
    return view('form');
})->name('form');

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/artikel_1', function () {
    return view('isi_artikel');
})->name('artikel_1');

Route::get('/panduan_dm', function () {
    return view('panduan_dm');
});

Route::post('/guides', [GuideController::class, 'store'])->name('guides.store');
Route::post('/store', [ReportController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
Route::post('/report/store', [ReportController::class, 'store'])->name('form.store');


// ==========================================
// RUTE GUEST (Hanya untuk yang belum login)
// ==========================================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Rute untuk Logout (Harus di luar guest)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==========================================
// RUTE AUTH (Wajib Login untuk Mengakses)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');

    // Fitur User / Umum
    Route::get('/user', [UserController::class, 'user'])->name('user');
    Route::get('/panduan', [GuideController::class, 'userIndex'])->name('panduan');
    Route::get('/guides/create', [GuideController::class, 'create'])->name('guides.create');
    Route::get('/guides/{guide}', [GuideController::class, 'show'])->name('guides.show');

    // Fitur Laporan & Lacak (Digabung ke middleware auth biasa)
    Route::get('/lacak', [ReportController::class, 'lacak'])->name('lacak');
    Route::get('/lacak_dm', [ReportController::class, 'lacak_dm'])->name('lacak_dm');
    Route::get('/lacak_ulasan', [ReportController::class, 'lacak_ulasan'])->name('lacak_ulasan');
    
    // Fitur Admin (Kelola Panduan & Laporan)
    Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('/duktek_form', [ReportController::class, 'index'])->name('duktek_form');
    Route::get('/report/get', [ReportController::class, 'getAllReports'])->name('reports.get'); 
    
    // Aksi pada Laporan
    Route::post('/report/{id}/accept', [ReportController::class, 'accept'])->name('report.accept');
    Route::post('/report/{id}/reject', [ReportController::class, 'reject'])->name('report.reject');
    Route::post('/report/{id}/complete', [ReportController::class, 'complete'])->name('report.complete');
    Route::post('/report/{id}/review', [ReportController::class, 'submitReview'])->name('report.review');
    
    // Aksi pada Panduan
    Route::get('/guides/{guide}/edit', [GuideController::class, 'edit'])->name('guides.edit');
    Route::put('/guides/{guide}', [GuideController::class, 'update'])->name('guides.update');
    Route::delete('/guides/{guide}', [GuideController::class, 'destroy'])->name('guides.destroy');

    // Aksi pada Ulasan
    Route::get('/ulasan/{id}', [ReportController::class, 'showReview'])->name('isi_ulasan');
    Route::post('/reviews', [ReportController::class, 'storeReview'])->name('review.store');
    Route::delete('/reviews/{id}', [ReportController::class, 'deleteReview'])->name('review.destroy');
});