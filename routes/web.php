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


Route::get('/ulasan', function () {
    return view('ulasan');
})->name('ulasan');


Route::get('/lacak_dm', function () {
    return view('lacak_dm');
});

Route::get('/lacak_ulasan', function () {
    return view('lacak_ulasan');
});

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

Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/guides/create', [GuideController::class, 'create'])->name('guides.create');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/panduan', [GuideController::class, 'userIndex'])->name('panduan');
    Route::get('/user', [UserController::class, 'user'])->name('user');
    Route::get('/lacak_dm', [ReportController::class, 'lacak_dm'])->name('lacak_dm');
    Route::get('/guides/{guide}', [GuideController::class, 'show'])->name('guides.show');


});



// Rute untuk Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rute untuk Admin (duktek dan maintenance)
Route::middleware(['auth:admin'])->group(function () {

    Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('/lacak', [ReportController::class, 'lacak'])->name('lacak');
    Route::get('/duktek_form', [ReportController::class, 'index'])->name('duktek_form');
    Route::get('/report/get', [ReportController::class, 'getAllReports'])->name('reports.get'); 
    Route::post('/report/{id}/accept', [ReportController::class, 'accept'])->name('report.accept');
    Route::post('/report/{id}/reject', [ReportController::class, 'reject'])->name('report.reject');
    Route::delete('/guides/{guide}', [GuideController::class, 'destroy'])->name('guides.destroy');
    Route::get('/guides/{guide}/edit', [GuideController::class, 'edit'])->name('guides.edit');
    Route::put('/guides/{guide}', [GuideController::class, 'update'])->name('guides.update');
    });
    



Route::post('/guides', [GuideController::class, 'store'])->name('guides.store');
Route::post('/store', [ReportController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
Route::post('/report/store', [ReportController::class, 'store'])->name('form.store');

// Route untuk menyelesaikan laporan kerusakan
Route::post('/report/{id}/complete', [ReportController::class, 'complete'])->name('report.complete');
// Route untuk mengirim review laporan kerusakan
Route::post('/report/{id}/review', [ReportController::class, 'submitReview'])->name('report.review');

Route::get('/lacak_ulasan', [ReportController::class, 'lacak_ulasan'])->name('lacak_ulasan');
// Route untuk melihat ulasan berdasarkan ID laporan
Route::get('/ulasan/{id}', [ReportController::class, 'showReview'])->name('isi_ulasan');

// Route untuk menyimpan ulasan
Route::post('/reviews', [ReportController::class, 'storeReview'])->name('review.store');
Route::delete('/reviews/{id}', [ReportController::class, 'deleteReview'])->name('review.destroy');
//hapus data
Route::delete('/reviews/{id}', [ReportController::class, 'destroy'])->name('review.delete');
// Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('report.destroy');



Route::get('/artikel_1', function () {
    return view('isi_artikel');
})->name('artikel_1');

Route::get('/panduan_dm', function () {
    return view('panduan_dm');
});

