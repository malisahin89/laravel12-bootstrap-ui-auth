<?php

use App\Http\Controllers\Dashboard\BioLinkController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {return view('frontend.index');})->name('index');

Route::middleware('throttle:10,1')->group(function () {
    Route::get('/@{user}', [PageController::class, 'showProfile'])->name('showprofile');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

    // profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::put('/dashboard/profile/photo', [ProfileController::class, 'updatePhoto'])->name('dashboard.profile.photo.update');
    // biolink
    Route::get('/biolink', [BioLinkController::class, 'index'])->name('dashboard.profile.biolink');
    Route::put('/biolink/update', [BioLinkController::class, 'update'])->name('dashboard.profile.biolink.update');

    ////////////////////////////////////////BLADE TEMPLATE////////////////////////////////////////
    Route::prefix('blade')->group(function () {
        Route::get('/login', function () {return view('dashboard.auth.login');})->name('dashboard.auth.login');
        Route::get('/sign-up', function () {return view('dashboard.auth.signup');})->name('dashboard.auth.signup');
        Route::get('/reset-password', function () {return view('dashboard.auth.resetpass');})->name('dashboard.auth.resetpass');
        Route::get('/two-step-verification', function () {return view('dashboard.auth.verification');})->name('dashboard.auth.verification');
    });

    ////////////////////////////////////////CACHE CLEAR////////////////////////////////////////
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

////////////////////////////////////////404 & 429////////////////////////////////////////
Route::fallback(function () {
    $ip           = request()->ip();
    $key          = "404_requests_{$ip}";
    $maxAttempts  = 10;
    $decayMinutes = 1;
    $attempts     = Cache::get($key, 0);
    if ($attempts >= $maxAttempts) {
        return response()->view('errors.429', [], 429);
    }
    Cache::put($key, $attempts + 1, now()->addMinutes($decayMinutes));

    return response()->view('errors.404', [], 404);
});
