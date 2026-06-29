<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Admin panel
Route::prefix('admin')->group(function () {
    Route::get('login',  [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('logout',[AdminController::class, 'logout'])->name('admin.logout');
    Route::get('submissions', [AdminController::class, 'submissions'])->name('admin.submissions');
    Route::get('poll',        [AdminController::class, 'poll'])->name('admin.poll');
});

// Serve the Vue SPA for all other routes
Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
