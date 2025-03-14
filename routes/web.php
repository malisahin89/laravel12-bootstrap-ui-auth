<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {return view('welcome');});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');

    Route::get('/login', function () {return view('dashboard.auth.login');})->name('dashboard.auth.login');
    Route::get('/sign-up', function () {return view('dashboard.auth.signup');})->name('dashboard.auth.signup');
    Route::get('/reset-password', function () {return view('dashboard.auth.resetpass');})->name('dashboard.auth.resetpass');
    Route::get('/two-step-verification', function () {return view('dashboard.auth.verification');})->name('dashboard.auth.verification');

    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:cache');
        Artisan::call('optimize:clear');
        cache()->flush();
        return '<ul><li>cache:clear</li><li>config:clear</li><li>view:clear</li><li>route:clear</li><li>config:clear</li><li>optimize:clear</li></ul><h3>All Caches Cleared!!!</h3><br><button><a href="/dashboard">Return Back</a></button>';
    })->name('cacheclear');

});
